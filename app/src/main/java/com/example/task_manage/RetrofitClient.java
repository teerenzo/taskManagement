package com.example.task_manage;

import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class RetrofitClient {

    private static final String BASE_URL = "http://172.20.96.151/taskManagement/AppBacked/";
    private static com.example.task_manage.RetrofitClient myClient;
    private Retrofit retrofit;

    private RetrofitClient() {
        retrofit = new Retrofit.Builder().baseUrl(BASE_URL).addConverterFactory(GsonConverterFactory.create()).build();
    }

    public static synchronized com.example.task_manage.RetrofitClient getInstance() {
        if (myClient == null) {
            myClient = new com.example.task_manage.RetrofitClient();
        }
        return myClient;
    }

    public Api getAPI() {
        return retrofit.create(Api.class);

    }
}
