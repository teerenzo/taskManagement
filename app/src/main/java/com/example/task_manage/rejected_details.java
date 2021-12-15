package com.example.task_manage;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.widget.TextView;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class rejected_details extends AppCompatActivity {
    TextView projectNameTextView, taskNameTextView, feedbackTextView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_rejected_details);

        final String userId = getIntent().getStringExtra("userId");


        projectNameTextView = findViewById(R.id.proName);
        taskNameTextView = findViewById(R.id.tName);
        feedbackTextView = findViewById(R.id.feedback);

        getSupportActionBar().setTitle("Rejected Details");


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

        String title = getIntent().getStringExtra("title");
        String feedback = getIntent().getStringExtra("feedback");
        String projectName = getIntent().getStringExtra("projectName");

        projectNameTextView.setText(projectName);
        taskNameTextView.setText(title);
        feedbackTextView.setText(feedback);

    }
}