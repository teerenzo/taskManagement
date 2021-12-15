package com.example.task_manage;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.vishnusivadas.advanced_httpurlconnection.PutData;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class Profile extends AppCompatActivity {
    TextView namesTextView, emailTextView, phoneTextView, changePasswordTextView, userNameTextView;
    CheckBox htmlCheckBox, cssCheckBox, jsCheckBox, androidCheckBox, phpCheckBox;
    Button updateUserInfoBtn,logoutBtn;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

        getSupportActionBar().setTitle("User Profile");

        final String userId = getIntent().getStringExtra("userId");
        final Handler handler = new Handler(Looper.getMainLooper());
        namesTextView = findViewById(R.id.profileNames);
        emailTextView = findViewById(R.id.profileEmail);
        phoneTextView = findViewById(R.id.profilePhone);
        htmlCheckBox = findViewById(R.id.HtmlCheckBox);
        cssCheckBox = findViewById(R.id.CssCheckBox);
        jsCheckBox = findViewById(R.id.JsCheckBox);
        androidCheckBox = findViewById(R.id.AndroidCheckBox);
        phpCheckBox = findViewById(R.id.PhpCheckBox);
        updateUserInfoBtn = findViewById(R.id.updateUserInfo);
        changePasswordTextView = findViewById(R.id.ch_password);
        userNameTextView = findViewById(R.id.userName);
        logoutBtn=findViewById(R.id.logout);

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

        changePasswordTextView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), changePassword.class);
                intent.putExtra("userId", userId);
                startActivity(intent);
            }
        });

        logoutBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), MainActivity.class);
                startActivity(intent);
                finish();
            }
        });

        // phpCheckBox.setChecked(true);

        htmlCheckBox.setOnCheckedChangeListener((buttonView, isChecked) -> {
            if (htmlCheckBox.isChecked()) {
                check("html");
            } else {
                uncheck("html");
            }
        });
        cssCheckBox.setOnCheckedChangeListener((buttonView, isChecked) -> {
            if (cssCheckBox.isChecked()) {
                check("css");
            } else {
                uncheck("css");
            }
        });
        jsCheckBox.setOnCheckedChangeListener((buttonView, isChecked) -> {
            if (jsCheckBox.isChecked()) {
                check("js");
            } else {
                uncheck("js");
            }
        });
        androidCheckBox.setOnCheckedChangeListener((buttonView, isChecked) -> {
            if (androidCheckBox.isChecked()) {
                check("android");
            } else {
                uncheck("android");
            }
        });
        phpCheckBox.setOnCheckedChangeListener((buttonView, isChecked) -> {
            if (phpCheckBox.isChecked()) {
                check("php");
            } else {
                uncheck("php");
            }
        });


        handler.post(new Runnable() {
            @Override
            public void run() {
                //Creating array for parameters
                String[] field = new String[1];
                field[0] = "userId";

                //Creating array for data
                String[] data = new String[1];
                data[0] = userId;

                PutData putData = new PutData(url.getLink() + "/getUserInfo.php", "POST", field, data);

                if (putData.startPut()) {
                    String result = null;
                    if (putData.onComplete()) {
                        result = putData.getResult();
                        try {
                            JSONArray array = new JSONArray(result);


                            JSONObject object = array.getJSONObject(0);
                            String names = object.getString("names");
                            String email = object.getString("email");
                            String phone = object.getString("phone");

                            userNameTextView.setText(names);
                            namesTextView.setText(names);
                            emailTextView.setText(email);
                            phoneTextView.setText(phone);


                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(getApplicationContext(), result, Toast.LENGTH_LONG).show();

                        }
                    }
                }

            }
        });

        handler.post(new Runnable() {
            @Override
            public void run() {
                //Creating array for parameters
                String[] field = new String[1];
                field[0] = "userId";

                //Creating array for data
                String[] data = new String[1];
                data[0] = userId;

                PutData putData = new PutData(url.getLink() + "/getUserSkills.php", "POST", field, data);

                if (putData.startPut()) {
                    String result = null;
                    if (putData.onComplete()) {
                        result = putData.getResult();
                        try {
                            JSONArray array = new JSONArray(result);


                            for (int i = 0; i < array.length(); i++) {

                                JSONObject object = array.getJSONObject(i);
                                String name = object.getString("name");
                                if (name.equals("php")) {
                                    phpCheckBox.setChecked(true);
                                }
                                if (name.equals("html")) {
                                    htmlCheckBox.setChecked(true);
                                }
                                if (name.equals("js")) {
                                    jsCheckBox.setChecked(true);
                                }
                                if (name.equals("css")) {
                                    cssCheckBox.setChecked(true);
                                }
                                if (name.equals("android")) {
                                    androidCheckBox.setChecked(true);
                                }


                            }


                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(getApplicationContext(), result, Toast.LENGTH_LONG).show();

                        }
                    }
                }

            }
        });


        updateUserInfoBtn.setOnClickListener(v -> {
            final String email = String.valueOf(emailTextView.getText());
            final String names = String.valueOf(namesTextView.getText());
            final String phone = String.valueOf(phoneTextView.getText());
            handler.post(new Runnable() {
                @Override
                public void run() {
                    //Creating array for parameters
                    String[] field = new String[4];
                    field[0] = "userId";
                    field[1] = "email";
                    field[2] = "names";
                    field[3] = "phone";

                    //Creating array for data
                    String[] data = new String[4];
                    data[0] = userId;
                    data[1] = email;
                    data[2] = names;
                    data[3] = phone;

                    PutData putData = new PutData(url.getLink() + "/updateUserInfo.php", "POST", field, data);
                    if (putData.startPut()) {
                        if (putData.onComplete()) {
                            String result = putData.getResult();
                            if (result.toString().equals("Data updated well done")) {

                                Toast.makeText(getApplicationContext(), result.toString(), Toast.LENGTH_SHORT).show();


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
        });


    }

    public void check(String skill) {

        final String userId = getIntent().getStringExtra("userId");
        final Handler handler = new Handler(Looper.getMainLooper());
        handler.post(new Runnable() {
            @Override
            public void run() {
                //Creating array for parameters
                String[] field = new String[2];
                field[0] = "userId";
                field[1] = "skill";


                //Creating array for data
                String[] data = new String[2];
                data[0] = userId;
                data[1] = skill;


                PutData putData = new PutData(url.getLink() + "/addSkill.php", "POST", field, data);
                if (putData.startPut()) {
                    if (putData.onComplete()) {
                        String result = putData.getResult();
                        if (result.toString().equals("Data added well")) {

                            // Toast.makeText(getApplicationContext(), result.toString(), Toast.LENGTH_SHORT).show();


                        } else {
                            //Toast.makeText(getApplicationContext(), result.toString(), Toast.LENGTH_SHORT).show();
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

    public void uncheck(String skill) {

        final String userId = getIntent().getStringExtra("userId");
        final Handler handler = new Handler(Looper.getMainLooper());
        handler.post(new Runnable() {
            @Override
            public void run() {
                //Creating array for parameters
                String[] field = new String[2];
                field[0] = "userId";
                field[1] = "skill";


                //Creating array for data
                String[] data = new String[2];
                data[0] = userId;
                data[1] = skill;


                PutData putData = new PutData(url.getLink() + "/removeSkill.php", "POST", field, data);
                if (putData.startPut()) {
                    if (putData.onComplete()) {
                        String result = putData.getResult();
                        if (result.toString().equals("Unchecked well")) {

                            Toast.makeText(getApplicationContext(), result.toString(), Toast.LENGTH_SHORT).show();


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
