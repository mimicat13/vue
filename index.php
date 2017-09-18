<!DOCTYPE HTML> 
<html>
	<head>
		<title>VUE</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<script src="vue.js"></script>
	</head>
	
	<body>
		<div id="app">
			<p>{{ message }}</p>
			<p v-bind:title="mytitle">title</p>
			<p v-if="seen">Visible if var seen is true</p>
			<ol>
				<li v-for="itm in my_array">
				{{ itm.text }}
				</li>
			</ol>
			
			<p>{{ long_message }}</p>
			<button v-on:click="reverseMessage">reverse</button>			
			
			<p>{{ imp_message }}</p>
			<input v-model="imp_message">
			
			
			<ul>
				<todo-item
					v-for="item in component_items"
					v-bind:stuff="item"
					v-bind:key="item.id"
					>
				</todo-item>
			</ul>			
		</div>	
		
		<script>
			Vue.component('todo-item', {
				props: ['stuff'],
				template: '<li>{{ stuff.text }}</li>'
			});			
			
			/*/
			// Наш объект data
			var data = { a: 1 }
			// Объект добавляется в экземпляр Vue
			var vm = new Vue({
			  data: data (or data:[] if nothing @ init but will be created later)
			})
			// Ссылки указывают на один и тот же объект!
			vm.a === data.a // => true
			// Изменение свойства экземпляра
			// будет влиять на оригинальные данные
			vm.a = 2
			data.a // => 2
			// ... и наоборот
			data.a = 3
			vm.a // => 3
			/**/
			
			var app = new Vue({
				el: '#app',
				data: {
					message: 'Test: ' + new Date().toLocaleString(),
					mytitle: 'My New Title',
					seen: true,
					
					my_array: [
						{ text: 'array value 0' },
						{ text: 'array value 1' },
						{ text: 'array value 2' }					
					],
					
					long_message: '0123456789',
					
					imp_message: 'input message',
					
					component_items: [
						{ id: 0, text: 'stuff 0' },
						{ id: 1, text: 'stuff 1' },
						{ id: 2, text: 'stuff 2' }
					]
				},
				methods: {
					reverseMessage: function () {
						this.long_message = this.long_message.split('').reverse().join('')
					}
				},
				
				created: function () {
					console.log('instance of vue: ' + this);
				}
				//mounted
				//	this.$nextTick(function () { 
				//		Код, который будет запущен только после 
				//		отображения всех представлений
				//	})
				//updated [try to avoid this func]
				//	  this.$nextTick(function () {
				//		Код, который будет запущен только после
				//		обновления всех представлений
				//	})
				//destroyed
			});
		</script>
				
	</body>
</html>