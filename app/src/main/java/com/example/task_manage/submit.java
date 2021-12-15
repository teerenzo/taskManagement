package com.example.task_manage;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.util.Base64;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.vishnusivadas.advanced_httpurlconnection.PutData;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class submit extends AppCompatActivity implements AdapterView.OnItemSelectedListener {
    Spinner taskSpinner, projectSpinner;
    Button SubmitButton, chooseFileBtn;
    EditText noteEditText;
    private int REQ_PDF = 21;
    private String encodedPDF;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_submit);
        getSupportActionBar().setTitle("Submit Task");
//        getSupportActionBar().setIcon();

        SubmitButton = findViewById(R.id.SubmitBtn);
        chooseFileBtn = findViewById(R.id.ChooseFileBtn);
        taskSpinner = findViewById(R.id.taskSpinner);
        projectSpinner = findViewById(R.id.projectSpinner);
        noteEditText = findViewById(R.id.noteEditText);

        final Handler handler = new Handler(Looper.getMainLooper());
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

        chooseFileBtn.setOnClickListener(v -> {
            Intent chooseFile = new Intent(Intent.ACTION_GET_CONTENT);
            chooseFile.setType("*/*");
            chooseFile = Intent.createChooser(chooseFile, "Choose a file");
            startActivityForResult(chooseFile, REQ_PDF);
        });
        SubmitButton.setOnClickListener(v -> {

            String project = projectSpinner.getSelectedItem().toString();
            String task = taskSpinner.getSelectedItem().toString();
            String note = String.valueOf(noteEditText.getText());
            uploadDocument(project, task, note);
        });


        final List<String> project = new ArrayList<String>();
        project.add("Select project");

        handler.post(new Runnable() {
            @Override
            public void run() {

                //Creating array for parameters
                String[] field = new String[1];
                field[0] = "userId";

                //Creating array for data
                String[] data = new String[1];
                data[0] = userId;

                PutData putData = new PutData(url.getLink() + "/selectProject.php", "POST", field, data);
                if (putData.startPut()) {

                    String result = null;
                    if (putData.onComplete()) {
                        // progressBar.setVisibility(View.GONE);
                        result = putData.getResult();
                        if (!result.toString().equals("No project found")) {

                            try {
                                JSONArray array = new JSONArray(result);

                                for (int i = 0; i < array.length(); i++) {

                                    JSONObject object = array.getJSONObject(i);
//                                    String id = object.getString("id");
                                    String name = object.getString("name");
                                    project.add(name);
                                }

                            } catch (JSONException e) {
                                e.printStackTrace();
                                Toast.makeText(getApplicationContext(), e.getMessage(), Toast.LENGTH_LONG).show();
                            }
                        } else {
                            project.add("No project Found!");
                        }
                    } else {
                        Toast.makeText(getApplicationContext(), result, Toast.LENGTH_SHORT).show();
                    }

                }
            }
            //End Write and Read data with URL
        });


        ArrayAdapter<String> projectAdapter = new ArrayAdapter<String>(getApplicationContext(), android.R.layout.simple_spinner_item, project);
        projectAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        projectSpinner.setAdapter(projectAdapter);
        projectSpinner.setOnItemSelectedListener(this);
    }


    private void uploadDocument(String project, String task, String note) {
        final String userId = getIntent().getStringExtra("userId");
        Call<ResponsePOJO> call = RetrofitClient.getInstance().getAPI().uploadDocument(encodedPDF, userId, project, task, note);
        call.enqueue(new Callback<ResponsePOJO>() {
            @Override
            public void onResponse(Call<ResponsePOJO> call, Response<ResponsePOJO> response) {

                Toast.makeText(getApplicationContext(), response.body().getRemarks(), Toast.LENGTH_SHORT).show();
                if (response.body().getRemarks().equals("document uploaded successfully")) {
                    Intent intent = new Intent(getApplicationContext(), Home.class);
                    intent.putExtra("userId", userId);
                    startActivity(intent);
                    finish();
                }
            }

            @Override
            public void onFailure(Call<ResponsePOJO> call, Throwable t) {
                Toast.makeText(getApplicationContext(), t.getMessage(), Toast.LENGTH_SHORT).show();

            }
        });
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == REQ_PDF && resultCode == RESULT_OK && data != null) {

            Uri path = data.getData();


            try {
                InputStream inputStream = getApplicationContext().getContentResolver().openInputStream(path);
                byte[] pdfInBytes = new byte[inputStream.available()];
                inputStream.read(pdfInBytes);
                encodedPDF = Base64.encodeToString(pdfInBytes, Base64.DEFAULT);

//                textView.setText("Document Selected");
//                btnSelect.setText("Change Document");

                Toast.makeText(this, "Document Selected", Toast.LENGTH_SHORT).show();

            } catch (IOException e) {
                e.printStackTrace();
            }

        }
    }

    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
        String selectedProject = parent.getItemAtPosition(position).toString();
        //get user ID
        final String userId = getIntent().getStringExtra("userId");

        final List<String> task = new ArrayList<String>();
        task.add("Select task");
        final Handler handler = new Handler(Looper.getMainLooper());

        handler.post(new Runnable() {
            @Override
            public void run() {

                //Creating array for parameters
                String[] field = new String[2];
                field[0] = "userId";
                field[1] = "project";

                //Creating array for data
                String[] data = new String[2];
                data[0] = userId;
                data[1] = selectedProject;

                PutData putData = new PutData(url.getLink() + "/selectTask.php", "POST", field, data);
                if (putData.startPut()) {

                    String result = null;
                    if (putData.onComplete()) {
                        // progressBar.setVisibility(View.GONE);
                        result = putData.getResult();
                        if (!result.toString().equals("No task found")) {

                            try {
                                JSONArray array = new JSONArray(result);

                                for (int i = 0; i < array.length(); i++) {

                                    JSONObject object = array.getJSONObject(i);
//                                    String id = object.getString("id");
                                    String name = object.getString("name");
                                    task.add(name);
                                }

                            } catch (JSONException e) {
                                e.printStackTrace();
                                Toast.makeText(parent.getContext(), e.getMessage(), Toast.LENGTH_LONG).show();
                            }
                        } else {
                           
                        }
                    } else {
                        Toast.makeText(parent.getContext(), result, Toast.LENGTH_SHORT).show();
                    }

                }
            }
            //End Write and Read data with URL
        });

        ArrayAdapter<String> taskAdapter = new ArrayAdapter<String>(getApplicationContext(), android.R.layout.simple_spinner_item, task);
        taskAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        taskSpinner.setAdapter(taskAdapter);
    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }
}