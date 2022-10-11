package com.example.hplaptop.icuonwheels;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;
import java.nio.Buffer;

public class Nurse extends AppCompatActivity {

    TextView tv1,tv2,tv3,tv4,tv5;
    PrefManager prefManager;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_nurse);
        prefManager=new PrefManager(getApplicationContext());

        tv1=(TextView)findViewById(R.id.nurse_name);
        tv2=(TextView)findViewById(R.id.experiance);
        tv3=(TextView)findViewById(R.id.qualification);
        tv4=(TextView)findViewById(R.id.phno);
        tv5=(TextView)findViewById(R.id.emailid);

        Pre_Nurse preNurse=new Pre_Nurse();
        preNurse.execute();
    }

    public class Pre_Nurse extends AsyncTask<Void,Void,String>{
        HttpURLConnection connection;
        String amb_username=prefManager.getName();

        String nname,nexp,nqua,nphno,nemail;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        @Override
        protected String doInBackground(Void... voids) {
            String text=null;
            BufferedReader reader=null;
            StringBuilder result=new StringBuilder();
            try {
                String data= URLEncoder.encode("amb","UTF-8")+"="+URLEncoder.encode(amb_username,"UTF-8");

                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/pre_nurse.php");
                connection=(HttpURLConnection)url.openConnection();
                connection.setDoOutput(true);
                connection.setRequestMethod("POST");

                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();

                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String line=null;
                while((line=reader.readLine())!=null) {
                    result.append(line);
                }
                text=result.toString();
                JSONArray jsonArray=new JSONArray(text);
                JSONObject obj;
                for(int i=0;i<jsonArray.length();i++) {
                    obj=jsonArray.getJSONObject(i);
                    nname=obj.getString("nurse_name").toString();
                    nexp=obj.getString("nurse_exper").toString();
                    nqua=obj.getString("nurse_qua").toString();
                    nphno=obj.getString("nurse_phno").toString();
                    nemail=obj.getString("nurse_email").toString();
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
            tv1.setText(nname);
            tv2.setText(nexp);
            tv3.setText(nqua);
            tv4.setText(nphno);
            tv5.setText(nemail);
        }
    }
}
