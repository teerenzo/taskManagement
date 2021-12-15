package com.example.task_manage;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.vishnusivadas.advanced_httpurlconnection.PutData;

public class Home extends AppCompatActivity {

    CardView newTaskCardView, submitCardView, approvedCardView, rejectedCardView;
    TextView totalEarn;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
        getSupportActionBar().hide();
        //get user ID
        final String userId = getIntent().getStringExtra("userId");

        BottomNavigationView bottomNavigationView1 = (BottomNavigationView) findViewById(R.id.bottom_navigation);
        //bottomNavigationView1.getMenu();

        bottomNavigationView1.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                switch (item.getItemId()) {
                    case R.id.account:
                        Intent intent = new Intent(getApplicationContext(), Profile.class);
                        intent.putExtra("userId", userId);
                        startActivity(intent);
                        break;

                    case R.id.homeNav:
                        Intent intent2 = new Intent(getApplicationContext(), Home.class);
                        intent2.putExtra("userId", userId);
                        startActivity(intent2);
                }
                return false;
            }
        });


        newTaskCardView = findViewById(R.id.NewTask);
        submitCardView = findViewById(R.id.Submit);
        approvedCardView = findViewById(R.id.Approved);
        rejectedCardView = findViewById(R.id.Rejected);
        totalEarn = findViewById(R.id.total);

        newTaskCardView.setOnClickListener(v -> {
            Intent intent = new Intent(getApplicationContext(), new_tasks.class);
            intent.putExtra("userId", userId);
            startActivity(intent);
            //Toast.makeText(this, "its working", Toast.LENGTH_SHORT).show();
        });

        submitCardView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), submit.class);
                intent.putExtra("userId", userId);
                startActivity(intent);
            }
        });

        approvedCardView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), approved.class);
                intent.putExtra("userId", userId);
                startActivity(intent);
            }
        });

        rejectedCardView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), rejected.class);
                intent.putExtra("userId", userId);
                startActivity(intent);
            }
        });


        final Handler handler = new Handler(Looper.getMainLooper());
        handler.post(new Runnable() {
            @Override
            public void run() {
                //Creating array for parameters
                String[] field = new String[1];
                field[0] = "userId";

                //Creating array for data
                String[] data = new String[1];
                data[0] = userId;

                PutData putData = new PutData(url.getLink() + "/getTotalEarns.php", "POST", field, data);
                if (putData.startPut()) {
                    if (putData.onComplete()) {
                        String result = putData.getResult();
                        if (!result.toString().equals("")) {
                            totalEarn.setText(result + " RWF");
                        } else {
                            Toast.makeText(getApplicationContext(), result.toString(), Toast.LENGTH_SHORT).show();
                        }

                    } else {
                        Toast.makeText(getApplicationContext(), "Network Error", Toast.LENGTH_SHORT).show();
                    }
                } else {
                    Toast.makeText(getApplicationContext(), "Network Error", Toast.LENGTH_SHORT).show();
                }
                //End Write and Read data with URL
            }
        });


    }


}

