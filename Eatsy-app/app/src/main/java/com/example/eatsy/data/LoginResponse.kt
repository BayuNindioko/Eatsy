package com.example.eatsy.data

data class LoginResponse(
    val status: String,
    val message: String,
    val data: LoginData
)

data class LoginData(
    val access_token: String
)
