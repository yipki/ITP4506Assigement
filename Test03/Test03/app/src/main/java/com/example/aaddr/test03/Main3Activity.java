package com.example.aaddr.test03;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;
import android.widget.Toolbar;

import com.github.mikephil.charting.data.PieData;
import com.github.mikephil.charting.data.PieDataSet;
import com.github.mikephil.charting.data.PieEntry;
import com.github.mikephil.charting.utils.ColorTemplate;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;

public class Main3Activity extends AppCompatActivity {

   private ListView lv_todoList;
   private todoListAdapter adapter;
   private List<todoList> mTodolList;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main3);
      //  Toolbar toolbar = findViewById(R.id.toolbar);
       // setSupportActionBar(toolbar);
        lv_todoList = (ListView)findViewById(R.id.lv_todoList);
        mTodolList = new ArrayList<>();
//        fetchData1 process = new fetchData1();
//        process.execute();

        adapter = new todoListAdapter(getApplicationContext(), mTodolList);
        lv_todoList.setAdapter(adapter);

        mTodolList.add(new todoList("3","DH1","shopping","headingggggg","21/3", R.drawable.ic_launcher_foreground, "Not Done"));
        mTodolList.add(new todoList("2","DH2","shopping","headingggggg","21/3", R.drawable.ic_launcher_foreground, "Not Done"));
        mTodolList.add(new todoList("3","DH1","shopping","headingggggg","21/3", R.drawable.tv_groceries, "Not Done"));
        mTodolList.add(new todoList("3","DH1","shopping","headingggggg","21/3", R.drawable.ic_report, "Not Done"));
adapter = new todoListAdapter(getApplicationContext(), mTodolList);
lv_todoList.setAdapter(adapter);

    }

public boolean onCreateOptionsMenu(Menu menu) {
    getMenuInflater().inflate(R.menu.toolbar, menu);
        return true;
}
@Override
public boolean onOptionsItemSelected(MenuItem item) {
        int id = item.getItemId();

        if (id==R.id.me_add) {
           // Toast.makeText(this, "add", Toast.LENGTH_SHORT).show();
            startActivity(new Intent(this, createTodoList.class));
            return true;
        }
        return super.onOptionsItemSelected(item);
}




}
