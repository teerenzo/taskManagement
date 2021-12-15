package com.example.task_manage;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.vishnusivadas.advanced_httpurlconnection.PutData;

public class SignUp extends AppCompatActivity {
    EditText namesEditText, emailEditText, phoneEditText, passwordEditText, confirmPasswordEditText;
    Button signUpBtn;
    TextView loginTextView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);
        namesEditText = findViewById(R.id.nameTextEdit);
        emailEditText = findViewById(R.id.emialTextEdit);
        phoneEditText = findViewById(R.id.phoneTextEdit);
        passwordEditText = findViewById(R.id.passwordTextEdit);
        confirmPasswordEditText = findViewById(R.id.cpasswordTextEdit);
        signUpBtn = findViewById(R.id.signupBtn);
        loginTextView = findViewById(R.id.loginText);

        signUpBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                //get input
                String names = String.valueOf(namesEditText.getText());
                String email = String.valueOf(emailEditText.getText());
                String phone = String.valueOf(phoneEditText.getText());
                String password = String.valueOf(passwordEditText.getText());
                String confirmPassword = String.valueOf(confirmPasswordEditText.getText());

                if (!names.equals("") && !email.equals("") && !phone.equals("") && !password.equals("") && !confirmPassword.equals("")) {
                    if (!password.equals(confirmPassword)) {
                        Toast.makeText(SignUp.this, "password don't match", Toast.LENGTH_SHORT).show();
                    } else {


                        Handler handler = new Handler(Looper.getMainLooper());
                        handler.post(new Runnable() {
                            @Override
                            public void run() {
                                //Starting Write and Read data with URL
                                //Creating array for parameters
                                String[] field = new String[4];
                                field[0] = "names";
                                field[1] = "email";
                                field[2] = "phone";
                                field[3] = "password";

                                //Creating array for data
                                String[] data = new String[4];
                                data[0] = names;
                                data[1] = email;
                                data[2] = phone;
                                data[3] = password;
                                PutData putData = new PutData(url.getLink() + "/signUp.php", "POST", field, data);
                                if (putData.startPut()) {
                                    if (putData.onComplete()) {
                                        String result = putData.getResult();
                                        if (result.toString().equals("Account created successful")) {

                                            Toast.makeText(getApplicationContext(), result.toString(), Toast.LENGTH_SHORT).show();
                                            Intent intent = new Intent(getApplicationContext(), MainActivity.class);
                                            startActivity(intent);


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
                } else {
                    Toast.makeText(getApplicationContext(), "All fields are required!", Toast.LENGTH_SHORT).show();
                }

            }
        });

        loginTextView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), MainActivity.class);
                startActivity(intent);
                finish();
            }
        });
    }
}