package com.example.my_app;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONObject;

import java.util.HashMap;

public class Soluction extends AppCompatActivity {

    private EditText etId;
    private TextView tvName, tvPrice, tvDesc,tvdate;

    public static final String URL_SHOW_PROD = "http://192.168.8.148/Web_project/soluctioon.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        getSupportActionBar().hide();

        setContentView(R.layout.activity_soluction);
        etId = findViewById(R.id.id);

        tvName = findViewById(R.id.showname);
        tvPrice = findViewById(R.id.showprice);
        tvDesc = findViewById(R.id.showdesc);
        tvdate = findViewById(R.id.date);

    }

    public void show_prod(View view){
        final String id = etId.getText().toString();

        class show_prod extends AsyncTask<Void, Void, String> {

            ProgressDialog pdLoading = new ProgressDialog(Soluction.this);

            @Override
            protected void onPreExecute() {
                super.onPreExecute();

                pdLoading.setMessage("\tLoading...");
                pdLoading.setCancelable(false);
                pdLoading.show();
            }

            @Override
            protected String doInBackground(Void... voids) {

                RequestHandler requestHandler = new RequestHandler();

                HashMap<String, String> params = new HashMap<>();
                params.put("bug_details_idbug_details", id);

                return requestHandler.sendPostRequest(URL_SHOW_PROD, params);
            }

            @Override
            protected void onPostExecute(String s){
                super.onPostExecute(s);
                pdLoading.dismiss();

                try{

                    JSONObject obj = new JSONObject(s);

                    if (!obj.getBoolean("error")){
                        Toast.makeText(Soluction.this, obj.getString("message"), Toast.LENGTH_LONG).show();

                        tvName.setVisibility(View.VISIBLE);
                        tvPrice.setVisibility(View.VISIBLE);
                        tvDesc.setVisibility(View.VISIBLE);
                        tvdate.setVisibility(View.VISIBLE);

                        tvName.setText("Solution Id: "+obj.getString("idbug_soluction"));
                        tvPrice.setText("Solution: "+obj.getString("soluction"));
                        tvDesc.setText("Date: "+obj.getString("time"));
                        tvdate.setText("Status: "+obj.getString("status"));
                    }
                } catch (Exception e ){
                    Toast.makeText(Soluction.this, "Exception: "+e, Toast.LENGTH_SHORT).show();
                }
            }
        }

        show_prod show = new show_prod();
        show.execute();
    }
}