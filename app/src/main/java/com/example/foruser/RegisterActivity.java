package com.example.foruser;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.material.textfield.TextInputEditText;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.android.gms.tasks.Task;
import java.util.HashMap;
import android.content.Intent;
import android.widget.Toast;
import android.text.TextUtils;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import org.json.JSONException;
import org.json.JSONObject;


public class RegisterActivity extends AppCompatActivity {

    TextInputEditText username, email ,password;
    //public static final String URL_REGISTER = "http://x90432sx.beget.tech/register.php";
    //public static final String URL_REGISTER = "http://172.26.68.117/register.php";
    public static final String URL_REGISTER = "http://10.0.0.5/register.php";
    FirebaseAuth auth;
    DatabaseReference reference;
    String techid = "T8v86I6R3VYPv56pMQVvQWu5tfF2";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setTitle("Регистрация");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);


        username = findViewById(R.id.username);
        email = findViewById(R.id.email);
        password = findViewById(R.id.password);


        auth=FirebaseAuth.getInstance();


    }
//регистрация нового пользователя
    private void register(final String username, String email, String password){

        auth.createUserWithEmailAndPassword(email, password)
                .addOnCompleteListener(new OnCompleteListener<AuthResult>() {
                    @Override
                    public void onComplete(@NonNull Task<AuthResult> task) {
                        if (task.isSuccessful()){
                            FirebaseUser firebaseUser = auth.getCurrentUser();
                            assert firebaseUser != null;
                            String userid = firebaseUser.getUid();

                            reference = FirebaseDatabase.getInstance().getReference("Users").child(userid);

                            HashMap<String, String> hashMap = new HashMap<>();
                            hashMap.put("id", userid);
                            hashMap.put("username", username);
                            hashMap.put("imageURL", "default");
                            hashMap.put("status", "offline");
                            hashMap.put("search", username.toLowerCase());
                    //переносим данные из хеш таблицы в БД "users"
                            reference.setValue(hashMap).addOnCompleteListener(new OnCompleteListener<Void>() {
                                @Override
                                public void onComplete(@NonNull Task<Void> task) {
                                    if (task.isSuccessful()){
                                        Intent intent = new Intent(RegisterActivity.this, MainActivity.class);
                                        intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NEW_TASK);
                                        startActivity(intent);
                                        finish();
                                    }
                                }
                            });
                            addtech(userid,techid);
                        } else {
                            Toast.makeText(RegisterActivity.this, "Вы не можете зарегестрироваться с этой почтой, попробуйте снова!", Toast.LENGTH_SHORT).show();
                        }
                    }
                });
    }

    private void addtech(String sender, final String userid){

        DatabaseReference reference = FirebaseDatabase.getInstance().getReference();

        HashMap<String, Object> hashMap = new HashMap<>();
        hashMap.put("sender", userid);
        hashMap.put("receiver", sender);
        hashMap.put("message", "Здравствуйте. Вас приветствует Тех.поддержка клуба <<Lion Club>>. Готовы ответить на любой ваш вопрос! ");
        hashMap.put("isseen", false);
//добавление в CHATs новые сообщения
        reference.child("Chats").push().setValue(hashMap);


        // добавляем чат с данным пользователем в свой список чатов
        final DatabaseReference chatRef = FirebaseDatabase.getInstance().getReference("Chatlist")
                .child(sender)
                .child(userid);

        chatRef.addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                if (!dataSnapshot.exists()){
                    chatRef.child("id").setValue(userid);
                }
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });
        // добавляем чат с данным пользователем в  список чатов собеседника
        final DatabaseReference chatRefReceiver = FirebaseDatabase.getInstance().getReference("Chatlist")
                .child(userid)
                .child(sender);
        chatRefReceiver.child("id").setValue(sender);
    }

    public void registersql(View view){
        final String username1 = username.getText().toString();
        final String email1 = email.getText().toString();
        final String password1 = password.getText().toString();

        if(username1.isEmpty() || email1.isEmpty() || password1.isEmpty()){
            Toast.makeText(this, "Пожалуйста, заполните все поля!", Toast.LENGTH_SHORT).show();
        }
        else if (password1.length() < 6 ){
            Toast.makeText(RegisterActivity.this, "Пароль должен иметь не менее 6 символов", Toast.LENGTH_SHORT).show();
        }
        else {
            class Login extends AsyncTask<Void, Void, String> {
                ProgressDialog pdLoading = new ProgressDialog(RegisterActivity.this);

                @Override
                protected void onPreExecute() {
                    super.onPreExecute();

                    //this method will be running on UI thread
                    pdLoading.setMessage("\tLoading...");
                    pdLoading.setCancelable(false);
                    pdLoading.show();
                }

                @Override
                protected String doInBackground(Void... voids) {
                    //creating request handler object
                    RequestHandler requestHandler = new RequestHandler();

                    //creating request parameters
                    HashMap<String, String> params = new HashMap<>();
                    params.put("email", email1);
                    params.put("password", password1);
                    params.put("username", username1);

                    //returing the response
                    return requestHandler.sendPostRequest(URL_REGISTER, params);
                }

                @Override
                protected void onPostExecute(String s) {
                    super.onPostExecute(s);
                    pdLoading.dismiss();

                    try {
                        //converting response to json object
                        JSONObject obj = new JSONObject(s);
                        //if no error in response
                        if (!obj.getBoolean("error")) {
                            Toast.makeText(getApplicationContext(), obj.getString("message"), Toast.LENGTH_LONG).show();
                            register(username1, email1, password1);
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                        Toast.makeText(RegisterActivity.this, "Exception: " + e, Toast.LENGTH_LONG).show();
                    }
                }
            }

            Login login = new Login();
            login.execute();
        }
    }
}