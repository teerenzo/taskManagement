package com.example.task_manage;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;

import android.os.Handler;
import android.os.Looper;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.vishnusivadas.advanced_httpurlconnection.PutData;

import java.util.List;


public class MainActivity extends AppCompatActivity {
    EditText emailTextEdit;
    EditText passwordTextEdit;
    TextView signTextView;
    Button loginBtn;
    ProgressBar progressBar;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        emailTextEdit = findViewById(R.id.email);
        passwordTextEdit = findViewById(R.id.loginPassword);
        loginBtn = findViewById(R.id.loginBtn);
        signTextView = findViewById(R.id.signupText);
        progressBar = findViewById(R.id.progress);
        final List<url> url;
        
        loginBtn.setOnClickListener(this::onClick);


            signTextView.setOnClickListener(v -> {
                Intent intent = new Intent(getApplicationContext(), SignUp.class);
                startActivity(intent);

            });
        }

    private void onClick(View v) {
        String email = String.valueOf(emailTextEdit.getText());
        String password = String.valueOf(passwordTextEdit.getText());
        if (!email.equals("") && !password.equals("")) {

            progressBar.setVisibility(View.VISIBLE);
            //Start ProgressBar first (Set visibility VISIBLE)
            Handler handler = new Handler(Looper.getMainLooper());
            handler.post(new Runnable() {
                @Override
                public void run() {
                    //Starting Write and Read data with URL
                    //Creating array for parameters
                    String[] field = new String[2];
                    field[0] = "email";
                    field[1] = "password";
                    //Creating array for data
                    String[] data = new String[2];
                    data[0] = email;
                    data[1] = password;
                    PutData putData = new PutData(url.getLink()+"/login.php", "POST", field, data);
                    if (putData.startPut()) {
                        if (putData.onComplete()) {
                            progressBar.setVisibility(View.GONE);
                            String result = putData.getResult();
                            if (!result.toString().equals("Wrong Email or Password")) {
                                String userId = result.toString();
                                Toast.makeText(getApplicationContext(), "Welcome", Toast.LENGTH_SHORT).show();
                                Intent intent = new Intent(getApplicationContext(), Home.class);
                                intent.putExtra("userId", userId);
                                startActivity(intent);
                                finish();

                            } else {
                                Toast.makeText(getApplicationContext(), result, Toast.LENGTH_SHORT).show();
                            }

                        } else {
                            progressBar.setVisibility(View.GONE);
                            Toast.makeText(getApplicationContext(), "Network Error", Toast.LENGTH_SHORT).show();
                        }
                    } else {
                        progressBar.setVisibility(View.GONE);
                        Toast.makeText(getApplicationContext(), "Network Error", Toast.LENGTH_SHORT).show();
                    }
                    //End Write and Read data with URL
                }
            });
        } else {
            Toast.makeText(getApplicationContext(), "All fields are required!", Toast.LENGTH_SHORT).show();
        }
    }
}