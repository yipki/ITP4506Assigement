package com.example.aaddr.test03;

import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.EventLogTags;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.darwindeveloper.horizontalscrollmenulibrary.custom_views.HorizontalScrollMenuView;
import com.github.mikephil.charting.charts.PieChart;
import com.github.mikephil.charting.data.Entry;
import com.github.mikephil.charting.data.PieData;
import com.github.mikephil.charting.data.PieDataSet;
import com.github.mikephil.charting.data.PieEntry;
import com.github.mikephil.charting.highlight.Highlight;
import com.github.mikephil.charting.listener.OnChartValueSelectedListener;
import com.github.mikephil.charting.utils.ColorTemplate;

import org.apache.commons.logging.Log;
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
import java.sql.Date;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.List;

public class MonthlyReport extends AppCompatActivity {
    // Button ExReport, DiReport, setEx;
    //BarChart barChart;
    ProgressBar progressBar2;
    PieChart pieChart;
    TextView tv_category_din, tv_category_gro, tv_category_oth, tv_date;
    TextView tv_count_din, tv_count_gro, tv_count_oth;
    ImageView tv_image_din, tv_image_gro, tv_image_oth;
    Spinner sp_month;
    TextView tv_month;
    String getMonth;
    Button btn_submit;

    public static TextView data;
    HorizontalScrollMenuView menu;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_monthly_report);
        tv_date = (TextView)findViewById(R.id.tv_date);
        pieChart = (PieChart) findViewById(R.id.pieChart);

        progressBar2 = (ProgressBar)findViewById(R.id.progressBar2);
        menu = (HorizontalScrollMenuView) findViewById(R.id.menu);
        tv_month = (TextView)findViewById(R.id.tv_month);
        sp_month = (Spinner)findViewById(R.id.sp_month);

        tv_count_din = (TextView)findViewById(R.id.tv_count_din);
        tv_count_gro = (TextView)findViewById(R.id.tv_count_gro);
        tv_count_oth = (TextView)findViewById(R.id.tv_count_oth);

        tv_category_din = (TextView)findViewById(R.id.tv_category_din);
        tv_category_gro = (TextView)findViewById(R.id.tv_category_gro);
        tv_category_oth = (TextView)findViewById(R.id.tv_category_oth);

        tv_image_din = (ImageView)findViewById(R.id.tv_image_din);
        tv_image_gro = (ImageView)findViewById(R.id.tv_image_gro);
        tv_image_oth = (ImageView)findViewById(R.id.tv_image_oth);
        btn_submit = (Button)findViewById(R.id.btn_submit);


        ArrayAdapter<CharSequence> adapter_month = ArrayAdapter.createFromResource(this, R.array. MonthlyReport_month, android.R.layout.simple_spinner_item);
        adapter_month.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        sp_month.setAdapter(adapter_month);
        sp_month.setSelection(adapter_month.getPosition("March"));


        //  initMenu();
        pieChart.setCenterText("Top \n Spending \nCategory");
        fetchData1 process = new fetchData1();
        process.execute();

        btn_submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                fetchData1 process = new fetchData1();
                process.execute();

            }
        });


    }

    public void GetDataFromSpinner() {
        getMonth = sp_month.getSelectedItem().toString();
//
//        if (getMonth.equals(null)) {
//            getMonth = "01";
//
//        }else {

            if (getMonth.equals("January")) {
                getMonth = "01";
            } else if (getMonth.equals("February")) {
                getMonth = "02";
            } else if (getMonth.equals("March")) {
                getMonth = "03";
            } else if (getMonth.equals("April")) {
                getMonth = "04";
            } else if (getMonth.equals("May")) {
                getMonth = "05";
            } else if (getMonth.equals("June")) {
                getMonth = "06";
            } else if (getMonth.equals("July")) {
                getMonth = "07";
            } else if (getMonth.equals("August")) {
                getMonth = "08";
            } else if (getMonth.equals("September")) {
                getMonth = "09";
            } else if (getMonth.equals("October")) {
                getMonth = "10";
            } else if (getMonth.equals("November")) {
                getMonth = "11";
            } else if (getMonth.equals("December")) {
                getMonth = "12";
            }
        }


//    class CustomAdapter extends BaseAdapter {
//
//        @Override
//        public int getCount() {
//            return 0;
//        }
//
//        @Override
//        public Object getItem(int i) {
//            return null;
//        }
//
//        @Override
//        public long getItemId(int i) {
//            return 0;
//        }
//
//        @Override
//        public View getView(int i, View view, ViewGroup viewGroup) {
//            view = getLayoutInflater().inflate(R.layout.customlayout, null);
//            ImageView imageView = (ImageView)findViewById(R.id.imageView);
//            TextView tv_category = (TextView)findViewById(R.id.tv_category);
//            TextView tv_count = (TextView)findViewById(R.id.tv_count);
//
//            return null;
//        }
//    }

//    private void initMenu() {
//        menu.addItem("", R.drawable.ic_report);
//        menu.addItem("", R.drawable.ic_dietre);
//        menu.addItem("Set Budget", R.drawable.ic_setex);


//        menu.setOnHSMenuClickListener(new HorizontalScrollMenuView.OnHSMenuClickListener() {
//            @Override
//            public void onHSMClick(MenuItem menuItem, int position) {
//
//                //  Toast.makeText(MonthlyReport.this, "asdasdas", Toast.LENGTH_LONG).show();
//                // if(menuItem.isSelected()) {
//
//                if (menuItem.getText() == "Ex Report") {
//                    //   startActivity(new Intent(MonthlyReport.this, MonthlyReport.class));
//                    fetchData process = new fetchData();
//                    process.execute();
//                } else if (menuItem.getText() == "Diet Report") {
//                    // startActivity(new Intent(MonthlyReport.this, MonthlyReport.class));
//                    fetchData1 process = new fetchData1();
//                    process.execute();
//                } else if (menuItem.getText() == "Set Budget") {
//                    startActivity(new Intent(MonthlyReport.this, Main3Activity.class));
//
//                }
//            }
//
//        });



    public class fetchData extends AsyncTask<Void, Void, Void> {
        String data = "";

        //        String dataParsed = "";
//        String singleParsed = "";
        @Override
        protected Void doInBackground(Void... voids) {

            try {
                URL url = new URL("http://fyp1718.onlinewebshop.net/php/employer/soccer.php");

                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                InputStream inputStream = httpURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
                String line = "";
                while (line != null) {
                    line = bufferedReader.readLine();
                    data = data + line;
                }

//                JSONArray JA = new JSONArray(data);
//                for (int i = 0; i<JA.length(); i++) {
//                    JSONObject JO = (JSONObject) JA.get(i);
//                    singleParsed = "Employer ID:" + JO.get("employerId") + "\n" +
//                            "Item:" + JO.get("item") + "\n" +
//                            "Tatal Expense:" + JO.get("totalExpense") + "\n" +
//                            "Item ID:" + JO.get("itemId") + "\n";
//
//                    dataParsed = dataParsed + singleParsed + "\n";
//                }
                //test
//                List<PieEntry> pieEntries = new ArrayList<>();
//                for (int j = 0; j<JA.length(); j++ ) {
//                    pieEntries.add(new PieEntry(expense[j], ));
//                }
//                PieDataSet dataSet =  new PieDataSet(pieEntries, "Test:");
//                PieData pdata = new PieData(dataSet);
//                PieChart chart = (PieChart) findViewById(R.id.chart);
//
//                chart.setData(pdata);
//                chart.invalidate();


                JSONArray jsonArray = new JSONArray(data);
                List<PieEntry> pieEntries = new ArrayList<>();
                for (int x = 0; x < jsonArray.length(); x++) {

                    JSONObject jsonObject = jsonArray.getJSONObject(x);

                    String tExpense = jsonObject.getString("ItemBoughtPrice").trim();
                    String iName = jsonObject.getString("ItemID").trim();

                    pieEntries.add(new PieEntry(Float.parseFloat(tExpense), iName));

                }

                PieDataSet pieDataSet = new PieDataSet(pieEntries, "Expense");
                pieDataSet.setColor(ColorTemplate.getHoloBlue());
                PieData theData = new PieData(pieDataSet);
                pieChart.setData(theData);
                pieChart.setRotationEnabled(true);
                pieChart.setCenterText("Top 5 Category");
                // pieChart.animateY(1000, Easing.EasingOption.EaseInCubic);
                pieChart.invalidate();

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            } catch (JSONException e) {
                e.printStackTrace();
            }

            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
//            BarData theData = new BarData(barDataSet);
//            barChart.setData(theData);
//            barChart.setTouchEnabled(true);
//            barChart.setDragEnabled(true);
//            barChart.setScaleEnabled(true);
            // MonthlyReport.data.setText(this.dataParsed);
            //barChart.setData();
        }
    }


    public class fetchData1 extends AsyncTask<Void, Void, Void> {
        String data = "";
        String dataParsed = "";
        String singleParsed = "";

        @Override
        protected Void doInBackground(Void... voids) {

            try {
                URL url = new URL("http://fyp1718.onlinewebshop.net/php/employer/soccer.php");

                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                InputStream inputStream = httpURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
                String line = "";
                while (line != null) {
                    line = bufferedReader.readLine();
                    data = data + line;
                }
                GetDataFromSpinner();
                JSONArray jsonArray = new JSONArray(data);
                List<PieEntry> pieEntries = new ArrayList<>();
                double totalCount = 0;

                double dinCount = 0;
                double groCount = 0;
                double othCount = 0;

                String dinCategory = null;
                String groCategory = null;
                String othCategory = null;

                final double dinCountFin;
                double groCountFin;
                double othCountFin;
                String iCategory = null;
                

                for (int x = 0; x < jsonArray.length(); x++) {

                    JSONObject jsonObject = jsonArray.getJSONObject(x);

                    String tExpense = jsonObject.getString("ItemBoughtPrice").trim();
                    Date date1 = Date.valueOf(jsonObject.getString("recordDate"));
                    String month1 = jsonObject.getString("recordDate").trim();
                    String iCat = jsonObject.getString("ItemCategory").trim();

                   // %%%
                    SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");

                    //java.util.Date selectDate =  sdf.parse(month1);

                    String startDateString = "2018-" + getMonth + "-01";
                    java.util.Date startDate = sdf.parse(startDateString);

                    String endDateString = "2018-" + getMonth + "-31";
                    java.util.Date endDate = sdf.parse(endDateString);

                    if (date1.after(startDate)&&date1.before(endDate)) {

                        totalCount = totalCount + Double.parseDouble(tExpense);
                        pieChart.setCenterText("Top \n Spending \nCategory");

                        if (iCat.equals("dining")) {
                            dinCount = dinCount + Double.parseDouble(tExpense);
                            tv_category_din.setText("Dining");
                            tv_count_din.setText("$" + Double.toString(dinCount));
                            dinCategory = iCat;
                        } else if (iCat.equals("groceries")) {
                            groCount = groCount + Double.parseDouble(tExpense);
                            tv_category_gro.setText("groceries");
                            tv_count_gro.setText("$" + Double.toString(groCount));
                            groCategory = iCat;
                        } else if (iCat.equals("others")) {
                            othCount = othCount + Double.parseDouble(tExpense);
                            tv_category_oth.setText("others");
                            tv_count_oth.setText("$" + Double.toString(othCount));
                            othCategory = iCat;
                        }
                    }
                    else {
                        tv_category_din.setText("Dining");
                        tv_count_din.setText("$ 0");

                        tv_category_gro.setText("groceries");
                        tv_count_gro.setText("$ 0");

                        tv_category_oth.setText("others");
                        tv_count_oth.setText("$ 0");
                        pieChart.setCenterText("No spending record found!");



                    }

                    }


                dinCountFin = 100-((totalCount - dinCount)/totalCount * 100);
               // tv_image_din.setBackgroundResource(R.drawable.tv_dining);
              //  tv_count_din.setText("$"+(int) dinCount);
               // tv_category_din.setText("Dining");
                // tvTest.setText((int) dinCountFin);
                groCountFin = 100-((totalCount - groCount)/totalCount * 100);
//                tv_image_gro.setBackgroundResource(R.drawable.tv_groceries);
//                tv_count_gro.setText("$"+(int) groCount);
//                tv_category_gro.setText("groceries");
                othCountFin = 100-((totalCount - othCount)/totalCount * 100);
//                tv_image_oth.setBackgroundResource(R.drawable.tv_others);
//                tv_count_oth.setText("$"+(int) othCount);
//                tv_category_oth.setText("others");

                String dinCountFinS = dinCountFin + "%";
                 if(dinCountFin!=0) {
                    pieEntries.add(new PieEntry(Float.parseFloat(String.valueOf(dinCountFin)), dinCategory));
                }if(groCountFin!=0) {
                    pieEntries.add(new PieEntry(Float.parseFloat(String.valueOf(groCountFin)), groCategory));
                }if(othCountFin!=0) {
                    pieEntries.add(new PieEntry(Float.parseFloat(String.valueOf(othCountFin)), othCategory));
                }
                PieDataSet pieDataSet = new PieDataSet(pieEntries, "");
                pieDataSet.setValueTextSize(15f);
                pieDataSet.setColors(ColorTemplate.COLORFUL_COLORS);
                PieData theData = new PieData(pieDataSet);
                pieChart.setData(theData);
                pieChart.setRotationEnabled(true);
                pieChart.setCenterTextSize(14);
                pieChart.setUsePercentValues(true);
                pieChart.invalidate();
//
//
//                pieChart.setOnChartValueSelectedListener(new OnChartValueSelectedListener() {
//                    @Override
//                    public void onValueSelected(Entry e, Highlight h) {
//                        Toast.makeText(MonthlyReport.this, "Total spend on " + dinCountFin, Toast.LENGTH_LONG);
//
//
//                    }
//
//                    @Override
//                    public void onNothingSelected() {
//
//                    }
//                });

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            } catch (JSONException e) {
                e.printStackTrace();
            } catch (ParseException e) {
                e.printStackTrace();
            }

            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);


        }
    }
}
//
//    public class fetchDataEx extends AsyncTask<Void, Void, Void> {
//        String data = "";
//
//        @Override
//        protected Void doInBackground(Void... voids) {
//
//            try {
//                URL url = new URL("http://10.0.2.2:8080/soccer.php");
//
//                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
//                InputStream inputStream = httpURLConnection.getInputStream();
//                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
//                String line = "";
//                while (line != null) {
//                    line = bufferedReader.readLine();
//                    data = data + line;
//                }
//                JSONArray jsonArray = new JSONArray(data);
//                double Num = 0;
//                double countP ;
//                String textt = null;
//                //List<PieEntry> pieEntries = new ArrayList<>();
//                for (int x = 0; x < jsonArray.length(); x++) {
//
//                    JSONObject jsonObject = jsonArray.getJSONObject(x);
//
//                    String tExpense = jsonObject.getString("itemBoughtPrice");
//                    //String iName = jsonObject.getString("itemId").trim();
//                    // pieEntries.add(new PieEntry(Float.parseFloat(tExpense)));
//                    // int toExpense = + jsonObject.getInt("totalExpense");
//
//
//                    textt = textt + tExpense;
//
//                    Num = Num + Double.parseDouble(tExpense);
//                    double Num2 = Double.parseDouble(userEx);
//                    countP = (Num2 - Num)/Num2 *100;
//                    progressBar.setProgress(100-(int) countP);
//                    totalSp.setText("           " +Double.toString(100- countP) + "%" + "\n" +"Current spending");
//                    sumEx.setText("$" + Double.toString(Num));
//                    //totalSp.setText(Double.toString(countP));
//
//
//                }
//
//                //totalSp.setText("asdasd");
//
//
//            } catch (MalformedURLException e) {
//                e.printStackTrace();
//            } catch (IOException e) {
//                e.printStackTrace();
//            } catch (JSONException e) {
//                e.printStackTrace();
//            }
//
//            return null;
//        }
//
//        @Override
//        protected void onPostExecute(Void aVoid) {
//            super.onPostExecute(aVoid);
//
//
//        }
//    }





