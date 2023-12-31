package com.example.eatsy.data

import com.google.gson.annotations.SerializedName

data class TableResponseItem(
	@SerializedName("id")
	val id: Int? = null,

	@SerializedName("number")
	val number: String? = null,

	@SerializedName("status")
	val status: String? = null,

	@SerializedName("created_at")
	val createdAt: Any? = null,

	@SerializedName("updated_at")
	val updatedAt: Any? = null,
	val reservation: List<Reservation>
)
data class Reservation(
	val id: Int,
	val table_id: Int,
	val name: String,
	val pin: String,
	val status: String,
	val created_at: String?,
	val updated_at: String?
)

