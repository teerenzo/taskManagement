package com.example.task_manage;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.widget.TextView;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class task_details extends AppCompatActivity {
    TextView titleTextView, descriptionTextView, techTextView, earnTextView, deadlineTextView, projectNameTextView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_task_details);
        getSupportActionBar().setTitle("Task Details");
        titleTextView = findViewById(R.id.task_name);
        descriptionTextView = findViewById(R.id.task_details);
        techTextView = findViewById(R.id.required_technology);
        earnTextView = findViewById(R.id.earn);
        deadlineTextView = findViewById(R.id.deadline);
        projectNameTextView = findViewById(R.id.projectName);


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

        String title = getIntent().getStringExtra("title");
        String description = getIntent().getStringExtra("description");
        String tech = getIntent().getStringExtra("tech");
        String deadline = getIntent().getStringExtra("deadline");
        String earn = getIntent().getStringExtra("earn");
        String projectName = getIntent().getStringExtra("projectName");

        titleTextView.setText(title);
        descriptionTextView.setText(description);
        techTextView.setText(tech);
        deadlineTextView.setText(deadline);
        earnTextView.setText(earn);
        projectNameTextView.setText(projectName);

    }
}