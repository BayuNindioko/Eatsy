package com.example.eatsy.login

import android.content.Context
import android.content.SharedPreferences
import android.util.Log
import android.widget.Toast
import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import com.example.eatsy.R
import com.example.eatsy.api.ApiConfig
import com.example.eatsy.data.LoginResponse
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class LoginViewModel : ViewModel() {

    private val _loginResult = MutableLiveData<Boolean>()
    val loginResult: LiveData<Boolean> = _loginResult
    private val _showProgressBar = MutableLiveData<Boolean>()
    val showProgressBar: LiveData<Boolean> = _showProgressBar

    fun signInWithEmailAndPassword(email: String, password: String, context: Context) {
        _showProgressBar.value = true

        val apiService = ApiConfig().getApiService()

        apiService.login(email, password).enqueue(object : Callback<LoginResponse> {
            override fun onResponse(
                call: Call<LoginResponse>,
                response: Response<LoginResponse>
            ) {
                if (response.isSuccessful) {
                    val loginResponse = response.body()
                    if (loginResponse?.status == "success" && loginResponse.data != null) {
                        val token = loginResponse.data.access_token
                        Log.d("tokenn", "Token: $token")
                        _loginResult.value = true
                        saveTokenToSharedPreferences(token, context)

                    } else {
                        _loginResult.value = false
                    }
                } else {
                    _loginResult.value = false
                }

                _showProgressBar.value = false
            }

            override fun onFailure(call: Call<LoginResponse>, t: Throwable) {
                _loginResult.value = false
                _showProgressBar.value = false
                Log.e("LoginViewModel", "Kesalahan permintaan login: ${t.message}")
            }
        })

    }

    private fun saveTokenToSharedPreferences(token: String, context: Context) {
        val sharedPreferences: SharedPreferences = context.getSharedPreferences("MyPrefs", Context.MODE_PRIVATE)
        val editor: SharedPreferences.Editor = sharedPreferences.edit()
        editor.putString("TOKEN", token)


        Log.d("bayo", "Token: $token")
        editor.apply()
    }

}