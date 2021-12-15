package com.example.task_manage;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.vishnusivadas.advanced_httpurlconnection.PutData;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class rejected extends AppCompatActivity {
    ListView rejectedList;
    TextView isEmpty;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_rejected);
        rejectedList = findViewById(R.id.rejected_list);
        isEmpty = findViewById(R.id.isEmpty);
        getSupportActionBar().setTitle("Rejected Tasks");
        final List<rejectedData> RejectedData;
        RejectedData = new ArrayList<>();

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

        //get tasks from database
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

                PutData putData = new PutData(url.getLink() + "/getRejectedTasks.php", "POST", field, data);
                if (putData.startPut()) {

                    String result = null;
                    if (putData.onComplete()) {
                        // progressBar.setVisibility(View.GONE);
                        result = putData.getResult();
                        if (!result.toString().equals("You have no new task")) {
                            try {
                                JSONArray array = new JSONArray(result);

                                for (int i = 0; i < array.length(); i++) {

                                    JSONObject object = array.getJSONObject(i);
                                    String projectName = object.getString("projectName");
                                    String taskId = object.getString("taskId");
                                    String feedback = object.getString("feedback");
                                    String taskName = object.getString("taskName");


                                    RejectedData.add(new rejectedData(projectName, taskId, taskName, feedback));

                                }
                                rejectedAdapter rejectedAdapter = new rejectedAdapter(getApplicationContext(), R.layout.rejected_item, RejectedData);
                                rejectedList.setAdapter(rejectedAdapter);
                            } catch (JSONException e) {
                                e.printStackTrace();
                                Toast.makeText(getApplicationContext(), e.getMessage(), Toast.LENGTH_LONG).show();
                            }
                        } else {
                            isEmpty.setVisibility(View.VISIBLE);
                        }
                    } else {
                        Toast.makeText(getApplicationContext(), result, Toast.LENGTH_SHORT).show();

                    }

                }
            }
            //End Write and Read data with URL

        });

//        for just testing

//        RejectedData.add(new rejectedData("projectName", "taskId", "taskName", "feedback"));
//        rejectedAdapter rejectedAdapter = new rejectedAdapter(getApplicationContext(), R.layout.rejected_item, RejectedData);
//        rejectedList.setAdapter(rejectedAdapter);

        rejectedList.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                Intent intent = new Intent(getApplicationContext(), rejected_details.class);

                String title = RejectedData.get(i).getTitle();
                String feedback = RejectedData.get(i).getFeedback();
                String projectName = RejectedData.get(i).getProjectName();

                intent.putExtra("userId", userId);
                intent.putExtra("projectName", projectName);
                intent.putExtra("title", title);
                intent.putExtra("feedback", feedback);

                startActivity(intent);
            }
        });

    }
}