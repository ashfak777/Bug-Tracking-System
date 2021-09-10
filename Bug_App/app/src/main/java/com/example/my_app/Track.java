package com.example.my_app;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONObject;

import java.util.HashMap;

public class Track extends AppCompatActivity {

    private EditText etId,uuid;
    private TextView tvName, tvPrice, tvDesc,tvdate,tvstatus;

    public static final String URL_SHOW_PROD = "http://192.168.8.148/Web_project/track_data.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        getSupportActionBar().hide();

        setContentView(R.layout.activity_track);
        etId = findViewById(R.id.id);

        tvName = findViewById(R.id.showname);
        tvPrice = findViewById(R.id.showprice);
        tvDesc = findViewById(R.id.showdesc);
        tvdate = findViewById(R.id.date);
        tvstatus = findViewById(R.id.status);

        uuid = (EditText) findViewById(R.id.uid);

        User user = SharedPrefManager.getInstance(this).getUser();
        uuid.setText(String.valueOf(user.getId()));
    }

    public void show_prod(View view){
        final String id = etId.getText().toString();
        final String sid = uuid.getText().toString();

        class show_prod extends AsyncTask<Void, Void, String> {

            ProgressDialog pdLoading = new ProgressDialog(Track.this);

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
                params.put("idbug_details", id);
                params.put("user_iduser", sid);

                return requestHandler.sendPostRequest(URL_SHOW_PROD, params);
            }

            @Override
            protected void onPostExecute(String s){
                super.onPostExecute(s);
                pdLoading.dismiss();

                try{

                    JSONObject obj = new JSONObject(s);

                    if (!obj.getBoolean("error")){
                        Toast.makeText(Track.this, obj.getString("message"), Toast.LENGTH_LONG).show();

                        tvName.setVisibility(View.VISIBLE);
                        tvPrice.setVisibility(View.VISIBLE);
                        tvDesc.setVisibility(View.VISIBLE);
                        tvdate.setVisibility(View.VISIBLE);
                        tvstatus.setVisibility(View.VISIBLE);

                        tvName.setText("Topic: "+obj.getString("bug_topic"));
                        tvPrice.setText("Priority: "+obj.getString("bug_piroty"));
                        tvDesc.setText("Details: "+obj.getString("bug_deatails"));
                        tvdate.setText("Date: "+obj.getString("time"));
                        tvstatus.setText("Status: "+obj.getString("status"));
                    }
                } catch (Exception e ){
                    Toast.makeText(Track.this, "Exception: "+e, Toast.LENGTH_SHORT).show();
                }
            }
        }

        show_prod show = new show_prod();
        show.execute();
    }

}