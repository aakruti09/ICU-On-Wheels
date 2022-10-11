package com.example.hplaptop.icuonwheels;

import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.annotation.TargetApi;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.app.LoaderManager.LoaderCallbacks;
import android.content.Loader;
import android.database.Cursor;
import android.os.AsyncTask;

import android.os.Build;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.KeyEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.inputmethod.EditorInfo;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;
import java.util.regex.Pattern;

/**
 * A login screen that offers login via username/password.
 */
public class LoginActivity extends AppCompatActivity {

    private UserLoginTask mAuthTask = null;

    // UI references.
    private AutoCompleteTextView mEmailView;
    private EditText mPasswordView;
    private View mProgressView;
    private View mLoginFormView;
    PrefManager prefManager;

    TextView t1,t2;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        prefManager=new PrefManager(getApplicationContext());

        t1=findViewById(R.id.forget_pwd_lbl);
        t2=findViewById(R.id.register_lbl);

        t1.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(getApplicationContext(),ForgetPassword.class));
            }
        });

        t2.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(getApplicationContext(),Registration.class));
            }
        });

        // Set up the login form.
        mEmailView = (AutoCompleteTextView) findViewById(R.id.email);


        mPasswordView = (EditText) findViewById(R.id.password);
        mPasswordView.setOnEditorActionListener(new TextView.OnEditorActionListener() {
            @Override
            public boolean onEditorAction(TextView textView, int id, KeyEvent keyEvent) {
                if (id == EditorInfo.IME_ACTION_DONE || id == EditorInfo.IME_NULL) {
                    attemptLogin();
                    return true;
                }
                return false;
            }
        });

        Button mEmailSignInButton = (Button) findViewById(R.id.email_sign_in_button);
        mEmailSignInButton.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View view) {
                attemptLogin();
            }
        });

        mLoginFormView = findViewById(R.id.login_form);
        mProgressView = findViewById(R.id.login_progress);
    }

    @Override
    public void onBackPressed() {
        finish();
        moveTaskToBack(true);
    }


    /**
     * Attempts to sign in or register the account specified by the login form.
     * If there are form errors (invalid email, missing fields, etc.), the
     * errors are presented and no actual login attempt is made.
     */
    private void attemptLogin() {


        // Reset errors.
        mEmailView.setError(null);
        mPasswordView.setError(null);

        // Store values at the time of the login attempt.
        String email = mEmailView.getText().toString();
        String password = mPasswordView.getText().toString();

        boolean cancel = false;
        View focusView = null;

        // Check for a valid password, if the user entered one.
        if (!TextUtils.isEmpty(password) && !isPasswordValid(password)) {
            mPasswordView.setError("Password Length should be greater than 7 letters. "+getString(R.string.error_invalid_password));
            focusView = mPasswordView;
            cancel = true;
        }

        // Check for a valid email address.
        if (TextUtils.isEmpty(email)) {
            mEmailView.setError(getString(R.string.error_field_required));
            focusView = mEmailView;
            cancel = true;
        } else if (!isEmailValid(email)) {
            mEmailView.setError("Username must start with alphabet. Username length should be between 8 to 20 letters. No special characters allowed.");
            focusView = mEmailView;
            cancel = true;
        }

        if (cancel) {
            // There was an error; don't attempt login and focus the first
            // form field with an error.
            focusView.requestFocus();
        } else {
            // Show a progress spinner, and kick off a background task to
            // perform the user login attempt.
            mAuthTask = new UserLoginTask(email, password);
            mAuthTask.execute((String) null);
        }
    }

    private boolean isEmailValid(String email) {
        //TODO: Replace this with your own logic

        return Pattern.matches("^[aA-zZ]\\w{7,19}$",email);
    }

    private boolean isPasswordValid(String password) {
        //TODO: Replace this with your own logic
        return password.length() > 7;
    }

    public class UserLoginTask extends AsyncTask<String, String, String> {

        private final String mEmail;
        private final String mPassword;
        String helper;

        UserLoginTask(String email, String password) {
            mEmail = email;
            mPassword = password;
        }

        @Override
        protected String doInBackground(String... params) {
            // TODO: attempt authentication against a network service.
            // encoding the url for making the post request
            HttpURLConnection connection;
            String data= null;
            try {

                data = URLEncoder.encode("name", "UTF-8")+"="+URLEncoder.encode(mEmail,"UTF-8");
                data+="&"+URLEncoder.encode("password","UTF-8")+"="+URLEncoder.encode(mPassword,"UTF-8");

            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            }

            Log.d("me", "inside the work backend work");
            String text=null;
            BufferedReader reader = null;

            try {
                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/signIn.php");

                // send post data requestt

                connection=(HttpURLConnection) url.openConnection();
                connection.setDoOutput(true);
                connection.setRequestMethod("POST");

                Log.d("me", "after url connection");

                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();

                // getting the responce from the server

                Log.d("me", "after sending the data to the server");

                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                StringBuilder builder=new StringBuilder();
                String temp=null;


                while ((temp=reader.readLine())!=null){

                    // appending the string
                    Log.d("me", "before buffer");

                    builder.append(temp);
                    Log.d("me", "after buffer");


                }
                text=builder.toString();
                Log.i("Data from php file",text);

            } catch (Exception e) {
                e.printStackTrace();

            }finally {
                try {
                    reader.close();
                } catch (Exception e) {
                    Log.d("its me", "doInBackground: here is problem");
                }
            }
            helper=text;
            return text;
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        @Override
        protected void onPostExecute(String s) {
            //mAuthTask = null;
            //showProgress(false);
            Toast.makeText(getApplicationContext(),s, Toast.LENGTH_LONG).show();
            Log.i("In post",s);
            if(s.trim().contains("Success"))
            {
                Log.i("Login",mEmail);
                saveLoginDetails(mEmail);
                Toast.makeText(getApplicationContext(), "Success", Toast.LENGTH_SHORT).show();
                startActivity(new Intent(getApplicationContext(),Navigator.class));
                finish();
            }
            else if(s.trim().contentEquals("Register plz")){
                Toast.makeText(getApplicationContext(), "Register Plz", Toast.LENGTH_SHORT).show();
                startActivity(new Intent(getApplicationContext(),Registration.class));
            }
            else if (s.trim().contentEquals("Wrong Password")){
                Toast.makeText(getApplicationContext(), "Wrong Password", Toast.LENGTH_LONG).show();
                mPasswordView.setText("");
            }
            else {
                Toast.makeText(getApplicationContext(), "Something is wrong either username or password.", Toast.LENGTH_LONG).show();
            }
        }

        private void saveLoginDetails(String str1) {
            new PrefManager(getApplicationContext()).saveLogindetails(str1);
        }

        @Override
        protected void onCancelled() {
            mAuthTask = null;
        }
    }
}

