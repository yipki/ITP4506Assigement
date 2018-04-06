package com.example.aaddr.test03;

import android.content.Context;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import org.w3c.dom.Text;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by aaddr on 26/3/2018.
 */

public class todoListAdapter extends ArrayAdapter<todoList>{

    private Context mContext;
    private List<todoList> mTodoList = new ArrayList<>();

    public todoListAdapter(Context mContext, List<todoList> mTodoList) {
        super(mContext, 0,mTodoList);
        this.mContext = mContext;
        this.mTodoList = mTodoList;

    }
    public int getCount () {
        return mTodoList.size();
    }
    public todoList getItem(int position) {
        return mTodoList.get(position);
    }
    public long getItemId(int position){
        return position;
    }

    public View getView(int position, View convertView, ViewGroup parent) {
        View v = View.inflate(mContext, R.layout.customlayout,null);
        TextView tv_critical = (TextView)v.findViewById(R.id.tv_critical);
        TextView tv_createdBy = (TextView)v.findViewById(R.id.tv_createdBy);
        TextView tv_heading = (TextView)v.findViewById(R.id.tv_heading);
        TextView tv_category = (TextView)v.findViewById(R.id.tv_category);
        TextView tv_date = (TextView)v.findViewById(R.id.tv_date);
        ImageView im_itemPhoto = (ImageView)v.findViewById(R.id.im_itemPhoto);
        TextView tv_status = (TextView)v.findViewById(R.id.tv_status);

        tv_critical.setText(mTodoList.get(position).getCritical());
        tv_createdBy.setText(mTodoList.get(position).getCreatedBy());
        tv_heading.setText(mTodoList.get(position).getHeading());
        tv_category.setText(mTodoList.get(position).getCategory());
        tv_date.setText(mTodoList.get(position).getDate());
        im_itemPhoto.setImageResource(mTodoList.get(position).getImage());
        tv_status.setText(mTodoList.get(position).getStatus());

        return v;

    }

//    public todoListAdapter (Context context, ArrayAdapter<todoList> list) {
//        super(context, 0, list);
//        mContext = context;
//        todoLists = list;
//
//    }


}
