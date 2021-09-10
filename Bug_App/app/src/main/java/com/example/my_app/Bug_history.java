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

public class Bug_history extends AppCompatActivity {

    private TextView tvone, tvtwo, tvthree,tvfour,tvfive;
    private EditText uuid;

    public static final String URL_SHOW_PROD = "http://192.168.8.148/Web_project/bug_history.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_bug_history);

        getSupportActionBar().hide();

        tvone = findViewById(R.id.one);
        tvtwo = findViewById(R.id.two);
        tvthree = findViewById(R.id.three);
        tvfour = findViewById(R.id.four);
        tvfive = findViewById(R.id.five);


        uuid = (EditText) findViewById(R.id.uid);

        User user = SharedPrefManager.getInstance(this).getUser();
        uuid.setText(String.valueOf(user.getId()));
    }

    public void show_prod(View view){

        final String sid = uuid.getText().toString();

        class show_prod extends AsyncTask<Void, Void, String> {

            ProgressDialog pdLoading = new ProgressDialog(Bug_history.this);

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
                        Toast.makeText(Bug_history.this, obj.getString("message"), Toast.LENGTH_LONG).show();

                        tvone.setVisibility(View.VISIBLE);
                        tvtwo.setVisibility(View.VISIBLE);
                        tvthree.setVisibility(View.VISIBLE);
                        tvfour.setVisibility(View.VISIBLE);
                        tvfive.setVisibility(View.VISIBLE);

                        tvone.setText("Bug Id: "+obj.getString("idbug_details"));
                        tvtwo.setText("Topic: "+obj.getString("bug_topic"));
                        tvthree.setText("Priority: "+obj.getString("bug_piroty"));
                        tvfour.setText("Description: "+obj.getString("bug_deatails"));
                        tvfive.setText("Date: "+obj.getString("time"));


                    }
                } catch (Exception e ){
                    Toast.makeText(Bug_history.this, "Exception: "+e, Toast.LENGTH_SHORT).show();
                }
            }
        }

        show_prod show = new show_prod();
        show.execute();
    }
}