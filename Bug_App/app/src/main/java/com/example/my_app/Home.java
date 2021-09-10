package com.example.my_app;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;

public class Home extends AppCompatActivity {

    Button buttontone;
    Button buttontwo;
    Button buttonthree;
    ImageButton buttonfour;
    ImageButton buttonfive;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        getSupportActionBar().hide();

        buttontone = (Button) findViewById(R.id.buttontone);
        buttontone.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openNewActivity();
            }
        });

        buttontwo = (Button) findViewById(R.id.buttontwo);
        buttontwo.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openNewActivity2();
            }
        });

        buttonthree = (Button) findViewById(R.id.buttonthree);
        buttonthree.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openNewActivity3();
            }
        });

        buttonfour = (ImageButton) findViewById(R.id.buttonfour);
        buttonfour.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openNewActivity4();
            }
        });

        buttonfive = (ImageButton) findViewById(R.id.buttonfive);
        buttonfive.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openNewActivity5();
            }
        });

    }
    private void openNewActivity() {
        Intent intent = new Intent(this, MainActivity.class);
        startActivity(intent);
    }

    private void openNewActivity2() {
        Intent intent = new Intent(this, Track.class);
        startActivity(intent);
    }

    private void openNewActivity3() {
        Intent intent = new Intent(this, Soluction.class);
        startActivity(intent);
    }

    private void openNewActivity4() {
        Intent intent = new Intent(this, Bug_history.class);
        startActivity(intent);
    }

    private void openNewActivity5() {
        Intent intent = new Intent(this, Profile.class);
        startActivity(intent);
    }

}