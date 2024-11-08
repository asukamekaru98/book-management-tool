package com.websarva.wings.android.book_management_tool.downloader

import android.content.Context
import android.graphics.Bitmap
import android.graphics.BitmapFactory
import android.util.Log
import com.bumptech.glide.Glide
import com.websarva.wings.android.book_management_tool.R
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.withContext

/**
 * 画像をダウンロードするクラス
 * @param context コンテキスト
 */
class ImageDownloader(private val context: Context) {

	/**
	 * 画像をダウンロードする
	 * @param url 画像のURL
	 * @return Bitmap? 画像データ
	 */
	suspend fun downloadImage(url: String): Bitmap {

		Log.d("BookMgmtTool ImageDownload URL:", url)

		return (if (url.startsWith("http")) {
			withContext(Dispatchers.IO) {
				Glide.with(context)
					.asBitmap()
					.load(url)
					.submit()
					.get()
			}
		} else {
			null
		}) ?: BitmapFactory.decodeResource(context.resources, R.drawable.skull)
	}
}