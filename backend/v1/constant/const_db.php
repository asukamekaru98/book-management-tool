<?php

# 汎用エラー
define('NO_PROB', 'NO_PROB'); // 問題なし
define('ERR_COMM', 'ERR_COMM'); // エラー（汎用）
define('ERR_DB_CONN', 'ERR_DB_CONN'); // データベース接続失敗
define('ERR_DB_EXECUTION', 'ERR_DB_EXECUTE'); // データベース実行失敗

# error login
define('ERR_LOGIN_NO_EXIST_USER', 'ERR_NO_EXIST_USER'); // ユーザ存在しない
define('ERR_LOGIN_PW_MISSMATCH', 'ERR_PW_MISSMATCH'); // パスワード一致しない

# error create account
define('ERR_CREATE_ACC_USER_NAME_DUPLICATE', 'ERR_USER_NAME_DUP'); // ユーザー名重複有り
define('ERR_CREATE_ACC_NON_EXISTING_DEP', 'ERR_NO_EXIST_DEP'); // 部署存在しない

# error registration customers info
define('ERR_REG_CUST_ID_DUPLICATE', 'ERR_CUSTOMER_ID_DUP'); // セットコード重複有り


# ツール権限
define('TOOL_AUTH_ALL', 1); // 
define('TOOL_AUTH_MANAGER', 2); // 
define('TOOL_AUTH_EDITOR', 3); // 
define('TOOL_AUTH_VIERER', 4); // 

/************************ I/F ************************/
# ログイン情報
// json リクエスト
define('UserSignIn', 'user_sign_in');
// json レスポンス
define('UserSignIn_Resp', 'user_sign_in_resp');
// list
define('UserSignInUser', 'user_sign_in_user');
define('UserSignInPw', 'user_sign_in_pw');

# アカウント作成
// json req
define('UserSignUp', 'user_sign_up');
// json resp
define('UserSignUp_Resp', 'user_sign_up_resp');
// list
define('UserSignUpUser', 'user_sign_up_user');
define('UserSignUpPw', 'cuser_sign_up_pw');
define('UserSignUpDep', 'user_sign_up_dep');

# 出荷先情報登録
// json req
define('CustReg', 'reg_customer');
// json resp
define('CustReg_Resp', 'reg_customer_resp');
// list
define('CustRegId', 'reg_customer_id');
define('CustRegName', 'reg_customer_name');

# 本体プログラム登録
// json req
define('ProgReg', 'programs_reg');
// json resp
define('ProgReg_Resp', 'programs_reg_resp');
// list
define('ProgRegPgVer', 'programs_reg_pg_ver');
define('ProgRegFileName', 'programs_reg_file_name');
define('ProgRegPgData', 'programs_reg_pg_data');

/************************ データベース ************************/
# usersテーブル
define('DB_Users', 'users');
define('DB_Users_Id', 'id');
define('DB_Users_Name', 'name');
define('DB_Users_Pw', 'password');
define('DB_Users_Dep', 'department');
define('DB_Users_CreateTime', 'created_time');
define('DB_Users_UpdateTime', 'updated_time');

# authoritiesテーブル
define('DB_Authorities_Id', 'id');
define('DB_Authorities_Type', 'type');
define('DB_Authorities_CreateTime', 'created_time');
define('DB_Authorities_UpdateTime', 'updated_time');

# departmentsテーブル
define('DB_Departments_Id', 'id');
define('DB_Departments_Name', 'users');
define('DB_Departments_Pw', 'authority');
define('DB_Departments_CreateTime', 'created_time');
define('DB_Departments_UpdateTime', 'updated_time');

# customersテーブル
define('DB_Customers', 'customers');
define('DB_Customers_Id', 'id');
define('DB_Customers_Name', 'name');
define('DB_Customers_CreateTime', 'created_time');
define('DB_Customers_UpdateTime', 'updated_time');

# programsテーブル
define('DB_Programs', 'programs');
define('DB_Programs_Id', 'id');
define('DB_Programs_PgVer', 'program_ver');
define('DB_Programs_FileName', 'file_name');
define('DB_Programs_PgData', '	program_data');
define('DB_Programs_CreateTime', 'created_time');
define('DB_Programs_UpdateTime', 'updated_time');
