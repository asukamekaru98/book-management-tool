<?php

# 汎用エラー
const NO_PROB = 'NO_PROB'; // 問題なし
const ERR_COMM = 'ERR_COMM'; // エラー（汎用）
const ERR_DB_CONN = 'ERR_DB_CONN'; // データベース接続失敗
const ERR_DB_EXECUTION = 'ERR_DB_EXECUTE'; // データベース実行失敗

# error login
const ERR_LOGIN_NO_EXIST_USER = 'ERR_NO_EXIST_USER'; // ユーザ存在しない
const ERR_LOGIN_PW_MISSMATCH = 'ERR_PW_MISSMATCH'; // パスワード一致しない

# error create account
const ERR_CREATE_ACC_USER_NAME_DUPLICATE = 'ERR_USER_NAME_DUP'; // ユーザー名重複有り
const ERR_CREATE_ACC_NON_EXISTING_DEP = 'ERR_NO_EXIST_DEP'; // 部署存在しない

# error registration customers info
const ERR_REG_CUST_ID_DUPLICATE = 'ERR_CUSTOMER_ID_DUP'; // セットコード重複有り

# ツール権限
const TOOL_AUTH_ALL = 1; // 
const TOOL_AUTH_MANAGER = 2; // 
const TOOL_AUTH_EDITOR = 3; // 
const TOOL_AUTH_VIERER = 4; // 

/************************ データベース ************************/
# usersテーブル
const DB_Users = 'users';
const DB_Users_Id = 'id';
const DB_Users_Name = 'name';
const DB_Users_Pw = 'password';
const DB_Users_Dep = 'department';
const DB_Users_CreateTime = 'created_time';
const DB_Users_UpdateTime = 'updated_time';

# authoritiesテーブル
const DB_Authorities_Id = 'id';
const DB_Authorities_Type = 'type';
const DB_Authorities_CreateTime = 'created_time';
const DB_Authorities_UpdateTime = 'updated_time';

# departmentsテーブル
const DB_Departments_Id = 'id';
const DB_Departments_Name = 'users';
const DB_Departments_Pw = 'authority';
const DB_Departments_CreateTime = 'created_time';
const DB_Departments_UpdateTime = 'updated_time';

# customersテーブル
const DB_Customers = 'customers';
const DB_Customers_Id = 'id';
const DB_Customers_Name = 'name';
const DB_Customers_CreateTime = 'created_time';
const DB_Customers_UpdateTime = 'updated_time';

# programsテーブル
const DB_Programs = 'programs';
const DB_Programs_Id = 'id';
const DB_Programs_PgVer = 'program_ver';
const DB_Programs_FileName = 'file_name';
const DB_Programs_PgData = 'program_data';
const DB_Programs_CreateTime = 'created_time';
const DB_Programs_UpdateTime = 'updated_time';
