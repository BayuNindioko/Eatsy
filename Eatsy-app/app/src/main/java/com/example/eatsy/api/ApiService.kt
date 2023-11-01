package com.example.eatsy.api


import com.example.eatsy.data.LoginResponse
import com.example.eatsy.data.LogoutResponse
import retrofit2.Call
import retrofit2.http.*

interface ApiService {
    @POST("users/login")
    @FormUrlEncoded
    fun login(
        @Field("email") email: String,
        @Field("password") password: String
    ): Call<LoginResponse>

    @GET("/api/users/logout")
    fun logout(
        @Header("Authorization") token: String,
    ) : Call<LogoutResponse>

}