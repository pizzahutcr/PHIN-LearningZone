var botName = "Admin",
botAvatar = "",
conversationData = {"homepage": {1: { "statement": [ 
"Hola Me llamo Admin,Soy el administrador del sitio estamos en Mantenimiento", 
"Alguna pregunta", 
"¿Cuál es su nombre?", 
], "input": {"name": "name", "consequence": 1.2}},1.2:{"statement": function(context) {return [ 
"Encantado de conocerte aquí, " + context.name  + "!", 
"How you can see, our website will be lauched very soon.", 
"I know, you are very excited to see it, but we need a few days to finish it.", 
"Would you like to be first to see it?", 
];},"options": [{ "choice": "Tell me more","consequence": 1.4},{ 
"choice": "Boring","consequence": 1.5}]},1.4: { "statement": [ 
"Cool! Please leave your email here and I will send you a message when it\'s ready.", 
], "email": {"email": "email", "consequence": 1.6}},1.5: {"statement": function(context) {return [ 
"Sad to hear that, " + context.name  + " :( See you next time…", 
];}},1.6: { "statement": [ 
"Got it! Thank you and see you soon here!", 
"Have a great day!", 
]}}};