package com.example.eatsy.ui.dashboard

import android.util.Log

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import com.example.eatsy.api.ApiConfig
import com.example.eatsy.data.TableReservationResponse
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class QueueViewModel : ViewModel() {
    private val apiService = ApiConfig().getApiService()
    private val tableData: MutableLiveData<List<TableReservationResponse>> = MutableLiveData()
    fun getTableData(): LiveData<List<TableReservationResponse>> = tableData

    fun fetchTableData() {
        apiService.getTableReservation().enqueue(object : Callback<List<TableReservationResponse>> {
            override fun onResponse(call: Call<List<TableReservationResponse>>, response: Response<List<TableReservationResponse>>) {
                if (response.isSuccessful) {
                    val tableList = response.body()

                    if (tableList.isNullOrEmpty()) {
                        tableData.postValue(emptyList())
                    } else {
                        tableData.postValue(tableList)
                    }
                }
            }

            override fun onFailure(call: Call<List<TableReservationResponse>>, t: Throwable) {
                Log.e("aldo", "Error: ${t.message}")
                t.printStackTrace()
            }
        })
    }
}

