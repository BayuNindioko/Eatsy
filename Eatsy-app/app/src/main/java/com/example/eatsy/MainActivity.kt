package com.example.eatsy

import android.content.Intent
import android.os.Bundle
import android.util.Log
import android.view.Menu
import android.view.MenuItem
import android.widget.Toast
import com.google.android.material.bottomnavigation.BottomNavigationView
import androidx.appcompat.app.AppCompatActivity
import androidx.navigation.findNavController
import androidx.navigation.ui.AppBarConfiguration
import androidx.navigation.ui.setupActionBarWithNavController
import androidx.navigation.ui.setupWithNavController
import com.example.eatsy.api.ApiConfig
import com.example.eatsy.data.LogoutResponse
import com.example.eatsy.databinding.ActivityMainBinding
import com.example.eatsy.login.LoginActivity
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class MainActivity : AppCompatActivity() {

    private lateinit var binding: ActivityMainBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        binding = ActivityMainBinding.inflate(layoutInflater)

        val sharedPreferences = getSharedPreferences("MyPrefs", MODE_PRIVATE)
        val isLoggedIn = sharedPreferences.getBoolean("isLoggedIn", false)
        setSupportActionBar(binding.toolbar)
        supportActionBar?.setDisplayShowTitleEnabled(false)

        Log.d("logindebug","$isLoggedIn")

        if (!isLoggedIn) {
            val intent = Intent(this, LoginActivity::class.java)
            startActivity(intent)
            finish()
        }

        setContentView(binding.root)
        val navView: BottomNavigationView = binding.navView

        val navController = findNavController(R.id.nav_host_fragment_activity_main)
        val appBarConfiguration = AppBarConfiguration(
            setOf(
                R.id.navigation_home, R.id.navigation_dashboard
            )
        )
        setupActionBarWithNavController(navController, appBarConfiguration)
        navView.setupWithNavController(navController)
    }

    override fun onCreateOptionsMenu(menu: Menu): Boolean {
        menuInflater.inflate(R.menu.main_menu, menu)
        return true
    }

    override fun onOptionsItemSelected(item: MenuItem): Boolean {
        when (item.itemId) {

            R.id.signOut -> {
                val sharedPreferences = getSharedPreferences("MyPrefs", MODE_PRIVATE)
                val token = sharedPreferences.getString("TOKEN", "")
                Log.d("bayo", "Token: $token")

                if (!token.isNullOrEmpty()) {
                    ApiConfig().getApiService().logout("Bearer $token").enqueue(object :
                        Callback<LogoutResponse> {
                        override fun onResponse(call: Call<LogoutResponse>, response: Response<LogoutResponse>) {
                            if (response.isSuccessful) {
                                Toast.makeText(this@MainActivity, "Logout Successfully!", Toast.LENGTH_SHORT).show()
                                startActivity(Intent(this@MainActivity, LoginActivity::class.java))
                                finish()

                                val editor = sharedPreferences.edit()
                                editor.clear()
                                editor.putBoolean("isLoggedIn", false)
                                editor.apply()


                            } else {
                                Log.d("bayyo", "${response.code()}")
                                Toast.makeText(this@MainActivity, "Failed to logout. Please try again.", Toast.LENGTH_SHORT).show()
                            }
                        }

                        override fun onFailure(call: Call<LogoutResponse>, t: Throwable) {
                            Log.e("bayo", "Logout onFailure: ${t.message}")
                            Toast.makeText(this@MainActivity, "Failed to logout. Please try again..", Toast.LENGTH_SHORT).show()
                        }
                    })
                }
//                val sharedPreferences = getSharedPreferences("MyPrefs", MODE_PRIVATE)
//                val editor = sharedPreferences.edit()
//                editor.clear()
//                editor.apply()
//
//
//                Toast.makeText(this, "Logout Successfully!", Toast.LENGTH_SHORT).show()
//                startActivity(Intent(this, LoginActivity::class.java))
//                finish()

            }
        }
        return super.onOptionsItemSelected(item)
    }
}