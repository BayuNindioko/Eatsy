package com.example.eatsy.ui.dashboard

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import android.widget.Toast
import androidx.recyclerview.widget.RecyclerView
import com.example.eatsy.R
import com.example.eatsy.data.TableReservationResponse

class TableAdapter(private var tableList: List<TableReservationResponse?>) :
    RecyclerView.Adapter<TableAdapter.TableViewHolder>() {

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): TableViewHolder {
        val view =
            LayoutInflater.from(parent.context).inflate(R.layout.item_table, parent, false)
        return TableViewHolder(view)
    }

    override fun onBindViewHolder(holder: TableViewHolder, position: Int) {
        val table = tableList[position]
        holder.bind(table)
    }

    override fun getItemCount(): Int {
        return tableList.size
    }

    inner class TableViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        private val numberTextView: TextView = itemView.findViewById(R.id.item_tv_minutes)
        private val nameTextView: TextView = itemView.findViewById(R.id.nama)
        init {
            itemView.setOnClickListener {
                Toast.makeText(itemView.context, "Wakwawww", Toast.LENGTH_SHORT).show()
            }
        }
        fun bind(table: TableReservationResponse?) {
            table?.let {
                numberTextView.text = it.table.number
                nameTextView.text = it.name
            }
        }
    }
}