package com.example.myapplication.pesanan

import android.util.Log
import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import com.example.eatsy.api.ApiConfig
import com.example.eatsy.data.OrderItem
import com.example.eatsy.data.OrderResponse
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class PesananViewModel : ViewModel() {
    private val _itemsLiveData: MutableLiveData<List<OrderItem>> = MutableLiveData()
    val itemsLiveData: LiveData<List<OrderItem>> get() = _itemsLiveData

    fun loadDataByTable(number: String, onResponse: (List<OrderItem>?) -> Unit) {
        val apiService = ApiConfig().getApiService()
        apiService.getOrderByTable(number).enqueue(object : Callback<OrderResponse> {
            override fun onResponse(
                call: Call<OrderResponse>,
                response: Response<OrderResponse>
            ) {
                if (response.isSuccessful) {
                    val orderResponse = response.body()
                    orderResponse?.let { order ->
                        val itemsList = order.order_items
                        _itemsLiveData.postValue(itemsList)
                        onResponse(itemsList)

                        itemsList.forEach { item ->
                            Log.d("FotoDebugsss", "Item ID: ${item.id}, Foto: ${item.item?.foto}")
                        }

                    }
                }
            }

            override fun onFailure(call: Call<OrderResponse>, t: Throwable) {
                Log.e("PesananViewModel", "Error: ${t.message}", t)
            }
        })
    }
}
