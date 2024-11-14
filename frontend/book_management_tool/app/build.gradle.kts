plugins {
	alias(libs.plugins.androidApplication)
	alias(libs.plugins.jetbrainsKotlinAndroid)
	kotlin("kapt")

}

android {
	namespace = "com.websarva.wings.android.book_management_tool"
	compileSdk = 34

	defaultConfig {
		applicationId = "com.websarva.wings.android.book_management_tool"
		minSdk = 34
		targetSdk = 34
		versionCode = 1
		versionName = "1.0"

		testInstrumentationRunner = "androidx.test.runner.AndroidJUnitRunner"
		vectorDrawables {
			useSupportLibrary = true
		}
	}

	buildTypes {
		release {
			isMinifyEnabled = false
			proguardFiles(
				getDefaultProguardFile("proguard-android-optimize.txt"),
				"proguard-rules.pro"
			)
		}
	}

	buildFeatures{
		viewBinding = true
	}

	compileOptions {
		sourceCompatibility = JavaVersion.VERSION_11
		targetCompatibility = JavaVersion.VERSION_11
	}
	kotlinOptions {
		jvmTarget = "11"
	}
	buildFeatures {
		compose = true
	}
	composeOptions {
		kotlinCompilerExtensionVersion = "1.5.1"
	}
	packaging {
		resources {
			excludes += "/META-INF/{AL2.0,LGPL2.1}"
		}
	}
}

dependencies {

	implementation(libs.androidx.core.ktx)
	implementation(libs.androidx.lifecycle.runtime.ktx)
	implementation(libs.androidx.activity.compose)
	implementation(platform(libs.androidx.compose.bom))
	implementation(libs.androidx.ui)
	implementation(libs.androidx.ui.graphics)
	implementation(libs.androidx.ui.tooling.preview)
	implementation(libs.androidx.material3)
	implementation(libs.androidx.appcompat)
	implementation(libs.androidx.constraintlayout)

	implementation("androidx.activity:activity:1.8.2")
	implementation("com.google.android.material:material:1.9.0")
	implementation("androidx.lifecycle:lifecycle-common:2.6.1")
	implementation("org.apache.commons:commons-text:1.9")
	implementation("com.google.code.gson:gson:2.8.9")
	implementation("com.squareup.okhttp3:okhttp:4.11.0")

	implementation ("com.github.bumptech.glide:glide:4.15.1")
	kapt ("com.github.bumptech.glide:compiler:4.15.1")

	testImplementation(libs.junit)
	androidTestImplementation(libs.androidx.junit)
	androidTestImplementation(libs.androidx.espresso.core)
	androidTestImplementation(platform(libs.androidx.compose.bom))
	androidTestImplementation(libs.androidx.ui.test.junit4)
	debugImplementation(libs.androidx.ui.tooling)
	debugImplementation(libs.androidx.ui.test.manifest)
}