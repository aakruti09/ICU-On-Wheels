package com.example.hplaptop.icuonwheels;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Spinner;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.regex.Pattern;

import static java.net.URLEncoder.encode;

public class Patient extends AppCompatActivity {

    Spinner pcondition,pcity,prelation;
    HttpURLConnection urlConnection;
    String[] cond_list,city_list,rel_list;
    ArrayAdapter<String> cond_adapter,city_adapter;
    ArrayAdapter rel_adapter;
    EditText pname,page,pocond,paddr,poccup,pphno,prelname;
    RadioGroup pgender,pmedi;
    RadioButton pgradio,pmradio;
    String p_name,p_age,p_ocond,p_addr,p_occup,p_phno,p_relname,p_condition,p_city,p_relation,p_gender,p_medi,lcity,larea;
    PrefManager prefManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_patient);
        prefManager=new PrefManager(getApplicationContext());

        pname=(EditText)findViewById(R.id.pat_name);
        page=(EditText)findViewById(R.id.pat_age);
        pocond=(EditText)findViewById(R.id.pat_cond_other);
        paddr=(EditText)findViewById(R.id.pat_address);
        poccup=(EditText)findViewById(R.id.pat_occ);
        pphno=(EditText)findViewById(R.id.pat_phone);
        prelname=(EditText)findViewById(R.id.pat_rel_name);
        pcondition=(Spinner)findViewById(R.id.pat_condition);
        pcity=(Spinner)findViewById(R.id.pat_city);
        prelation=(Spinner)findViewById(R.id.pat_relation);
        pgender=(RadioGroup)findViewById(R.id.pat_gender);
        pmedi=(RadioGroup)findViewById(R.id.pat_medi);

        //Get RadioButton Data
        int gId=pgender.getCheckedRadioButtonId();
        pgradio=(RadioButton)findViewById(gId);
        int mId=pmedi.getCheckedRadioButtonId();
        pmradio=(RadioButton)findViewById(mId);


        //Put data in relation Spinner
        rel_adapter= ArrayAdapter.createFromResource(getApplicationContext(),R.array.relation,android.R.layout.simple_spinner_dropdown_item);
        prelation.setAdapter(rel_adapter);

        //Put data into Condition and City Spinner
        Patient_Pre_Data patientPreData=new Patient_Pre_Data();
        patientPreData.execute();

        //Getting data from previous page
        Bundle receiver = getIntent().getExtras();
        lcity=receiver.getString("city");
        larea=receiver.getString("area");

        Button b=findViewById(R.id.done);
        b.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                int gId=pgender.getCheckedRadioButtonId();
                pgradio=(RadioButton)findViewById(gId);
                int mId=pmedi.getCheckedRadioButtonId();
                pmradio=(RadioButton)findViewById(mId);
                p_name=pname.getText().toString();
                p_age=page.getText().toString();
                p_gender=pgradio.getText().toString();
                p_condition=pcondition.getSelectedItem().toString();
                p_ocond=pocond.getText().toString();
                p_addr=paddr.getText().toString();
                p_city=pcity.getSelectedItem().toString();
                p_occup=poccup.getText().toString();
                p_phno=pphno.getText().toString();
                p_relation=prelation.getSelectedItem().toString();
                p_relname=prelname.getText().toString();
                p_medi=pmradio.getText().toString();


                if(TextUtils.isEmpty(p_name) || TextUtils.isEmpty(p_age) || TextUtils.isEmpty(p_addr) || TextUtils.isEmpty(p_occup) || TextUtils.isEmpty(p_phno) || TextUtils.isEmpty(p_relname))
                {
                    Toast.makeText(getApplicationContext(),"Enter data in all fields", Toast.LENGTH_LONG).show();
                }
                else if(!isAlpha(p_name) || !isAlpha(p_occup) || !isAlpha(p_relname)){
                    Toast.makeText(getApplicationContext(),"Enter name and occupation details properly", Toast.LENGTH_LONG).show();
                }
                else if(!isNumber(p_phno)){
                    pphno.setError("Enter Correct Phone Number");
                }
                else if(!isAge(p_age)){
                    page.setError("Enter Correct Age");
                }
                else {
                    new Send_Patient_Data().execute();
                    finish();
                }
            }
        });
    }

    private boolean isAlpha(String str) {
        return Pattern.matches("^[a-zA-Z][a-zA-Z\\s]{1,40}$",str);
    }

    private boolean isNumber(String n) {
        return Pattern.matches("^[6789]\\d{9}$",n);
    }
    private boolean isAge(String age) {
        return Pattern.matches("^(\\d{1,2}|100)$",age);
    }

    private class Patient_Pre_Data extends AsyncTask<Void,Void,Void> {

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  finish();   startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
        }

        protected Void doInBackground(Void...params){

            StringBuilder result=new StringBuilder();
            StringBuilder result1=new StringBuilder();
            String temp=null,temp2=null;
            BufferedReader bufferedReader=null;
            try{
                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/patient_pre_data.php");
                urlConnection=(HttpURLConnection) url.openConnection();
                Log.i("Connection : ","done!");
                Log.i("After","after");

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }

            try {
                String data1,data2;
                Log.i("problem is here", "doInBackground: 0 ");
                bufferedReader=new BufferedReader(new InputStreamReader(urlConnection.getInputStream()));
                String line="";
                while ((line=bufferedReader.readLine())!=null){
                    String temp1=line;
                    String[] dataa1=temp1.split("&");
                    data1=dataa1[0];
                    data2=dataa1[1];
                    result.append(data1);
                    result1.append(data2);
                    Log.i("problem is here", "doInBackground: 1 ");
                }
                temp=result.toString();
                temp2=result1.toString();
                Log.i("Result",temp2);
            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }finally {
                try {
                    bufferedReader.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }

            try {
                JSONArray jsonArray=new JSONArray(temp);
                JSONArray jsonArray1=new JSONArray(temp2);

                cond_list=new String[jsonArray.length()];
                city_list=new String[jsonArray1.length()];

                for (int j=0;j<jsonArray.length();j++){
                    JSONObject jsonObject=jsonArray.getJSONObject(j);
                    cond_list[j] = jsonObject.getString("disease_name").toString();
                }

                for (int j=0;j<jsonArray1.length();j++){
                    JSONObject jsonObject1=jsonArray1.getJSONObject(j);
                    city_list[j]=jsonObject1.getString("city").toString();
                    Log.i("city name",city_list[j]);
                }

            } catch (JSONException e) {
                e.printStackTrace();
            }
            return null;
        }
        protected void onPostExecute(Void result){
            cond_adapter=new ArrayAdapter(getApplicationContext(),R.layout.spinner_layout,R.id.txt,cond_list);
            city_adapter=new ArrayAdapter(getApplicationContext(),R.layout.spinner_layout,R.id.txt,city_list);

            pcondition.setAdapter(cond_adapter);
            pcity.setAdapter(city_adapter);
            pcondition.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                @Override
                public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                    String cond=pcondition.getSelectedItem().toString();
                    if(cond.contentEquals("Other")){
                        pocond.setEnabled(true);
                    } else {
                        pocond.setEnabled(false);
                    }
                }

                @Override
                public void onNothingSelected(AdapterView<?> parent) {

                }
            });
        }
    }
    class Send_Patient_Data extends AsyncTask<String,String,String>{

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  finish();   startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
        }

        @Override
        protected String doInBackground(String... strings) {
            String data=null,text=null;
            BufferedReader reader=null;

            try{
                data=encode("pname","UTF-8")+"="+encode(p_name,"UTF-8");
                data+="&"+encode("page","UTF-8")+"="+encode(p_age,"UTF-8");
                data+="&"+encode("pgender","UTF-8")+"="+ encode(p_gender,"UTF-8");
                data+="&"+encode("pcondition","UTF-8")+"="+encode(p_condition,"UTF-8");
                data+="&"+encode("pocond","UTF-8")+"="+ encode(p_ocond,"UTF-8");
                data+="&"+encode("paddr","UTF-8")+"="+encode(p_addr,"UTF-8");
                data+="&"+encode("pcity","UTF-8")+"="+ encode(p_city,"UTF-8");
                data+="&"+encode("poccu","UTF-8")+"="+encode(p_occup,"UTF-8");
                data+="&"+encode("pphno","UTF-8")+"="+ encode(p_phno,"UTF-8");
                data+="&"+encode("prel","UTF-8")+"="+encode(p_relation,"UTF-8");
                data+="&"+encode("prelname","UTF-8")+"="+ encode(p_relname,"UTF-8");
                data+="&"+encode("pmedi","UTF-8")+"="+encode(p_medi,"UTF-8");

                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/patient_details.php");
                HttpURLConnection connection=(HttpURLConnection)url.openConnection();
                connection.setRequestMethod("POST");
                connection.setDoOutput(true);

                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();

                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                StringBuilder builder=new StringBuilder();
                String temp;
                while((temp=reader.readLine())!=null){
                    builder.append(temp+"\n");
                }
                text=builder.toString();
            } catch (Exception e) {
                e.printStackTrace();
            }
            finally {
                try{
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
            String id=s.trim();
            if(prefManager.isInternetOn()){
                //Toast.makeText(getApplicationContext(),s,Toast.LENGTH_LONG).show();
                Intent i = new Intent(getApplicationContext(), Hospital_List.class);
                i.putExtra("area",larea);
                i.putExtra("city",lcity);
                i.putExtra("condition",p_condition);
                i.putExtra("mediclaim",p_medi);
                i.putExtra("patient",p_name);
                i.putExtra("p_id",id);
                startActivity(i);
            }
            else {
                startActivity(new Intent(getApplicationContext(),InternetCheck.class));
                finish();
            }
        }
    }
}
