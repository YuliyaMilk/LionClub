package com.example.foruser.Fragments;

import com.example.foruser.Notifications.MyResponse;
import com.example.foruser.Notifications.Sender;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.Headers;
import retrofit2.http.POST;
//для push-уведомлений
public interface APIService {
    @Headers(
            {
                    "Content-Type:application/json",
                    "Authorization:key=ADD HERE YOUR KEY FROM FIREBASE PROJECT"
            }
    )

    @POST("fcm/send")
    Call<MyResponse> sendNotification(@Body Sender body);
}
