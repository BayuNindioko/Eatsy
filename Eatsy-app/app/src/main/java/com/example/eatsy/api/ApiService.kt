package com.example.eatsy.api


import com.example.eatsy.data.CheckinResponse
import com.example.eatsy.data.DetailReservationResponse
import com.example.eatsy.data.LoginResponse
import com.example.eatsy.data.LogoutResponse
import com.example.eatsy.data.OrderResponse
import com.example.eatsy.data.TableReservationResponse
import com.example.eatsy.data.TableResponseItem
import com.example.eatsy.data.UpdateResponse
import retrofit2.Call
import retrofit2.http.*

interface ApiService {

    //reservasi
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

    //booking meja reservasi
    @GET("tables")
    fun getTable(
    ): Call<List<TableResponseItem>>

    @GET("/api/tables/{table_id}/reservations")
    fun detailReservation(
        @Path("table_id") id: Int,
    ) : Call<DetailReservationResponse>

    @POST("/api/tables/{table_id}/reservations")
    @FormUrlEncoded
    fun checkIn(
        @Path("table_id") table_id: Int,
        @Field("name") name :String
    ): Call<CheckinResponse>

    @POST("/api/tables/reservations/{id}")
    @FormUrlEncoded
    fun checkOut(
        @Path("id") id: Int,
        @Field("table_id") table_id: Int,
    ): Call<DetailReservationResponse>

    //pesanan
    @GET("/api/reservations")
    fun getTableReservation(
    ): Call<List<TableReservationResponse>>

    //detail pesanan
    @GET("/api/reservations/{id}/items")
    fun getOrderByTable(
        @Path("id") number: String
    ): Call<OrderResponse>

    @FormUrlEncoded
    @PATCH("order_items/{id}/")
    fun updateData(
        @Path("id") id: Int,
        @Field("quantity_delivered") QuantityDelivered:Int
    ) : Call<UpdateResponse>
}