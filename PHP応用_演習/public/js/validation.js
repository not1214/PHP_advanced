window.onload = function(){
	const submit = document.getElementById('submit');
	const name = document.getElementById('name');
	const kana = document.getElementById('kana');
	const tel = document.getElementById('tel');
	const email = document.getElementById('email');
	const body = document.getElementById('body');
	const val = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/;

	submit.addEventListener('click', function(event) {
		let message = [];

		if (name.value == "") {
			message.push("氏名が未入力です。");
		} else if (name.value.length > 10) {
			message.push("氏名を10文字以内で入力してください。");
		}
		if (kana.value == "") {
			message.push("フリガナが未入力です。");
		} else if (kana.value.length > 10) {
			message.push("フリガナを10文字以内で入力してください。");
		}
		if (tel.value.match(/^(0{1}\d{8,9,10})$/)) {
			message.push("正しい電話番号を入力してください。");
		}
		if (email.value == "") {
			message.push("メールアドレスが未入力です。")
		} else if (!val.test(email.value)) {
			message.push("メールアドレスの形式が不正です。")
		}
		if (body.value == "") {
			message.push("お問い合わせ内容が未入力です。")
		}
		
		if (message.length > 0) {
			let message_str = message.join('\n');
			alert(message_str);
		}
	});
};