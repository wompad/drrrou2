for(i = 0 ; i < a.length ; i++){

			msg  	= a[i].sms_text;
			msg 	= msg.split("|");
			msg 	= msg[msg.length-1];

			msg3 	= a[i].sms_text;
			msg3 	= msg3.split("|");


			if(a[i].sms_text.substr(0,2) == "E|"){

				for(var k = 0 ; k < (msg3.length-1) ; k++){
					if(k == 0){
						msg2 = msg2 + msg3[k];
					}else{
						msg2 = msg2 + "|" + msg3[k];
					}
					
				}

				for(var j = 0 ; j < bh.length ; j++){

					if(j == i){
						console.log(1);
					}else{
						if(bh[j].sms_text.includes(msg) > 0){

							msg5 = bh[j].sms_text;
							msg5 = msg5.split("|");

							for(var hh = 0 ; hh < (msg5.length - 1) ; hh++){
								msg2 = msg2 + msg5[hh];	
							}

							messages.push({
								message : msg2,
								time 	: a[i].sent_dt
							})
						}
					}

				}

			}

		}