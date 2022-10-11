package com.example.hplaptop.icuonwheels;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

public class View_Profile extends AppCompatActivity {

    ImageView pic;
    TextView tv1,tv2,tv3;
    Button b;
    String imageurl="http://192.168.43.177/ICUOnWheels/Android/upload/IMG_1538479717.jpg";
    PrefManager prefManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_view__profile);
        prefManager=new PrefManager(getApplicationContext());

        pic=(ImageView)findViewById(R.id.profilepic);
        tv1=(TextView)findViewById(R.id.puser);
        tv2=(TextView)findViewById(R.id.pambno);
        tv3=(TextView)findViewById(R.id.pro_number);

        View_Profiledata viewProfiledata=new View_Profiledata();
        viewProfiledata.execute();

        b=findViewById(R.id.editprobtn);
        b.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(getApplicationContext(),Edit_Profile.class));
                finish();
            }
        });
    }

    private void loadImg(String url) {
        Picasso.with(View_Profile.this).load(url).placeholder(R.mipmap.ic_launcher)
                .error(R.mipmap.ic_launcher)
                .into(pic, new com.squareup.picasso.Callback() {
                    @Override
                    public void onSuccess() {
                        Toast.makeText(getApplicationContext(), "Success", Toast.LENGTH_SHORT).show();
                    }

                    @Override
                    public void onError() {
                        Toast.makeText(getApplicationContext(), "Error", Toast.LENGTH_SHORT).show();
                    }
                });
    }

    private class View_Profiledata extends AsyncTask<Void,Void,String>{
        HttpURLConnection connection;
        PrefManager p=new PrefManager(getApplicationContext());
        String amb=p.getName();
        String d1,d2,d3,picstring;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        @Override
        protected String doInBackground(Void... voids) {
            BufferedReader reader=null;
            String data=null,text=null;
            StringBuilder result=new StringBuilder();

            try {
                data= URLEncoder.encode("amb","UTF-8")+"="+URLEncoder.encode(amb,"UTF-8");
                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/view_profile.php");
                connection=(HttpURLConnection)url.openConnection();
                connection.setDoOutput(true);
                connection.setRequestMethod("POST");
                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();
                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String line="";
                while((line=reader.readLine())!=null){
                    result.append(line);
                }
                text=result.toString();

                JSONArray jsonArray=new JSONArray(text);
                JSONObject obj;
                for(int i=0;i<jsonArray.length();i++){
                    obj=jsonArray.getJSONObject(i);
                    d1=obj.getString("amb_no").toString();
                    d2=obj.getString("image").toString();
                    d3=obj.getString("phno").toString();
                    Log.i("JSON data: ",d1+d2+d3);
                    picstring="http://192.168.43.177/ICUOnWheels/Android/upload/"+d2;
                }

            } catch (IOException e) {
                e.printStackTrace();
            } catch (JSONException e) {
                e.printStackTrace();
            } finally {
                try {
                    reader.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
            return text;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            tv1.setText(amb);
            tv2.setText(d1);
            loadImg(picstring);
            tv3.setText(d3);
        }

    }
}
