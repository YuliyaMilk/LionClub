package com.example.foruser;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentPagerAdapter;
import androidx.viewpager.widget.ViewPager;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.TextView;

//import com.example.chatapp.Fragments.ChatsFragment;
//import com.example.chatapp.Fragments.ProfileFragment;
//import com.example.chatapp.Fragments.UsersFragment;
//import com.example.chatapp.Model.Chat;
import com.example.foruser.Fragments.ChatsFragment;
import com.example.foruser.Fragments.ProfileFragment;
import com.example.foruser.Model.Chat;
import com.example.foruser.Model.User;
//import com.google.android.material.tabs.TabLayout;
import com.google.android.material.tabs.TabLayout;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;
import com.google.firebase.database.annotations.Nullable;

import java.util.ArrayList;
import java.util.HashMap;

import de.hdodenhof.circleimageview.CircleImageView;

public class MainActivity extends AppCompatActivity {

    CircleImageView profile_image;
    TextView username;

    FirebaseUser firebaseUser;
    DatabaseReference reference;

    private String userid = "D0YuQsyRU2hFegXcFZgnCssRJpw2";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setTitle("");

        profile_image = findViewById(R.id.profile_image);
        username = findViewById(R.id.username);

        firebaseUser = FirebaseAuth.getInstance().getCurrentUser();
        reference = FirebaseDatabase.getInstance().getReference("Users").child(firebaseUser.getUid());

//чтобы прочитать значение из БД, нужно присоединеть асинхроный наблюдательк связанному ключу или пути
        reference.addValueEventListener(new ValueEventListener() {
            @Override
            //этот метод дает доступ к объекту DataSnapshot

            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                User user = dataSnapshot.getValue(User.class);//получение последнего значения ключа
                username.setText(user.getUsername());
                if (user.getImageURL().equals("default")){ //Иконка по умолчанию
                    profile_image.setImageResource(R.drawable.icon2);
                }
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });

        final TabLayout tabLayout = findViewById(R.id.tab_layout);
        final ViewPager viewPager = findViewById(R.id.view_pager); //позволяет нам организовывать удобный просмотр данных с возможностью перелистывания вправо-влево


        reference = FirebaseDatabase.getInstance().getReference("Chats");
        reference.addValueEventListener(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                ViewPagerAdapter viewPagerAdapter = new ViewPagerAdapter(getSupportFragmentManager());
                int unread = 0; //количество непрочитанных писем
                for (DataSnapshot snapshot : dataSnapshot.getChildren()){  //проходимся по всем ключам, "chats"
                    Chat chat = snapshot.getValue(Chat.class); // считываем значение(то есть сообщение)
                    if (chat.getReceiver().equals(firebaseUser.getUid()) && !chat.isIsseen()){
                        unread++;
                    }
                }

                if (unread == 0){
                    viewPagerAdapter.addFragment(new ChatsFragment(), "Сообщения");
                } else {
                    viewPagerAdapter.addFragment(new ChatsFragment(), "("+unread+") Сообщения");
                }
//добавление в главном меню вкладок профиль и пользователи
               // viewPagerAdapter.addFragment(new UsersFragment(), "Контакты");
                viewPagerAdapter.addFragment(new ProfileFragment(), "Профиль");

                viewPager.setAdapter(viewPagerAdapter);//связывает подготовленный список с адаптерами

                tabLayout.setupWithViewPager(viewPager);//передаем viewPager в tabLayout

            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });


    }
    //появление значка выход..Создания меню, состоящего из одного элемента
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu, menu);
        return true;
    }
//привяжем к меню действия, те выход из акк
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()){

            case  R.id.logout:
                FirebaseAuth.getInstance().signOut();  //выход пользователя
                // change this code beacuse your app will crash
                startActivity(new Intent(MainActivity.this, StartActivity.class).setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP));
                return true;
        }

        return false;
    }
//основная страница
    class ViewPagerAdapter extends FragmentPagerAdapter {

        private ArrayList<Fragment> fragments;
        private ArrayList<String> titles;

        ViewPagerAdapter(FragmentManager fm){
            super(fm);
            this.fragments = new ArrayList<>();
            this.titles = new ArrayList<>();
        }

        @Override
        public Fragment getItem(int position) {
            return fragments.get(position);
        }

        @Override
        public int getCount() {
            return fragments.size();
        }

        public void addFragment(Fragment fragment, String title){
            fragments.add(fragment);
            titles.add(title);
        }

        // Ctrl + O

        @Nullable
        @Override
        public CharSequence getPageTitle(int position) {
            return titles.get(position);
        }
    }

    private void status(String status){
        reference = FirebaseDatabase.getInstance().getReference("Users").child(firebaseUser.getUid());

        HashMap<String, Object> hashMap = new HashMap<>();
        hashMap.put("status", status);

        reference.updateChildren(hashMap);
    }

    @Override
    protected void onResume() {
        super.onResume();
        status("online");
    }

    @Override
    protected void onPause() {
        super.onPause();
        status("offline");
    }


}
