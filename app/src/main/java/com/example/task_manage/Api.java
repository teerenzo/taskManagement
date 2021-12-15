package com.example.task_manage;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface Api {
    @FormUrlEncoded
    @POST("submit.php")
    Call<ResponsePOJO> uploadDocument(
            @Field("PDF") String encodedPDF,
            @Field("userId") String userId,
            @Field("project") String project,
            @Field("task") String task,
            @Field("note") String note

    );

}
