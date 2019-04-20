<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2018060260291542",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEAt4su56RGe5+8SCmhDuM4jB18X6mPuG7OfNAXTGNMBc98Tl6BkBA2IrdrjejZpyP9OkEYfIZb74wdLa5ISso8WqQUtinQe6/mLEvXSMNkG6F4a4nTvsHYEkb8yfLY+QfVwxJpTI5dnkBvgesgHg4blcxad/UlyCfbAHi6kL+2qKvwbEyKO8DiiRNtkOOcpzCqnkzRI4JKDwtAEM6+ppRsENQlGD0QtGtnkPlbfet+jsa2ANUJtE7KFW6Lx7stqOaceLURgdFMqtwagXWJApS8YEN5FAOyQNIOHyGUa52kV65h09cBRt1IYcHvL1jWfxXsOjpW7E20m7PK/79ItitwqwIDAQABAoIBAHc93DYvmn7cMsUrDnCOnAEjctbvYOiwTEP4KPq+k/g+aQK9ES1X6uO5CA4E1cppbi13dwIHhBjnjVlNHbhBFN7KNI54MfL5Pu9OQkoKbrIowAQVYdRPOSH+rmJA/EclmPGHt5M99oJGWGsuJwp/ndo/DhNa17XmdrgitwotEu0W1MMC2T4bcktDb83ws2LOX9GACwHk4WphI24bnsHRXHPqyfhq2ZODI7kM7MYEZYvFzYvldaB1le+CUyCx7FdyhlNDtjnvD2UMKblmjGR8w9wD7qmq1FNZef+2U5jr1ei4CIwY6IbcWLlhwUHFKH9tTXmH/m4ryy0bm8Bh0XWBNAECgYEA6bR87+/5SmVNaMWa6OSvRabG790Nz1DnXCRSco600EaY8mcuDV/eq9oOBJpKJvIyw2glpepl+Lkcv/kY/LsfiPxAGVdz4egR/vfXq7HJkVyxJMwyUvV17Hj/HafbE9tY+mCRGUHRankfs0xaebqVgFpRzbalb/fl8t3R8ZTbEgECgYEAyQ2pZZuIe7a3ytwtLKQKdfD53d9YUH2Jf77qW/55suIA9dYlSjR9+If8nWG1S3cQH+vmY+dHpxpudeYEMmZR3HQqTrtGEvIZfN3h0hDUi6+6BUPPe/xQHbi5Ruol6YYCHxl1p6luvbmHIZJ+cqySkvnO1pRG3IBos1ddLq5iaqsCgYAfewyJVY4DE3pF7rhbPtLNUxXhIanGj2Na6hmhDNAWbiwUGwn9Czj3dTwGKrJqZJ2p7NGFc/mgc28H/Qn8oUgyL6iCwWD+wUALVF9c5Wn9hrrl9guhWSc1X2ceG4pLNnTZ5UAmYtNOwFog0NwvIY8Z5xC14TCP0JjNCkxJen+4AQKBgQCE1DPQX1ticKsoqSJnVdFbbmOGRGKyet32uglX0d5RYqNDx8FHLzrykdVBnSYLv5O1o0LJSim6qunDlr27FoKK5Wx2K5/2MGDKcEUbZecmimiZxd00itPbbwlpYpS9nb2VElr69COn0QUIFyLXXFBSLhyLA9d1IpkJs3RqvOdklQKBgEd9JcfPGIIL7kTw4jr+P43mbT5Gt3gN3ZIIazbyj+4H2Oa46KLWNgd/TcwThrYQR3vn5/BxA9hdTyqT0jvsvBfUsNRicQ5h8UKfZKTu4nbbdDRUz/+Yj0RYaW08PJ7LsaU2AySu8CE9d/nEMWqRXQkLYg5tfX0xp8trjThmyili",
		
		//异步通知地址
		'notify_url' => "https://kgxcoin.com/assets/class/alipay/notify_url.php",
		
		//同步跳转 return_url.php
		'return_url' => "https://kgxcoin.com/trans.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAjKrLdj2kVCzQjmQBm71ZoToKk5ZABA0NDdFf+HfrvomVYinn574w10puvEU6yUETX/AEtFqo8T4uAXZUPgcEV/DgIgr2LnnD6TeO6JhBeQcaZmdpKqukQaqRCmkbFhQoZC7U1scGy83FxIZj6X+dYvrwBsPG9Mikfkx7nQLCqBRcnW2SORGyDLXtKnLGzS0gF3qHcMfQaabXuwx99ma6QDAYAZDrz+f726z0oclFu7ezwRmD9nGeyv4yPUp7+fnqPgcsePICsaxOcOmsxUbi3Og0pFCFJF/IB1/7Vy5nUDFTQXXQFKLUh0oqEU19gIxGIMavFFc+TR4qlmWyo1HSfwIDAQAB",

		
	
);