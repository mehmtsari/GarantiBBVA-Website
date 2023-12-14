


function inputValid(id, validClass, length=null,password2=null) {
    document.querySelector(id).addEventListener("keyup", function () {
        const tc = document.querySelector(id);
        const valid = document.querySelector(validClass);


        if (id === "#name"){
            // eğer orta kısımlarında boşluk varsa ve lengthten uzunsa ve boşlukla başlamıyorsa ve boşlukla bitmiyorsa
            if (tc.value.match(/\s/g) && tc.value.length > length && !tc.value.startsWith(" ") && !tc.value.endsWith(" ")) {
                // eğer lengthten uzunsa ve sayı içermiyorsa
                            
                if (tc.value.length > length && !tc.value.match(/[0-9]/g)) {
                    valid.classList.add("text-success");
                    valid.classList.remove("text-danger");
                }
                else {
                    valid.classList.add("text-danger");
                    valid.classList.remove("text-success"); 
                }
            }
            else {
                valid.classList.add("text-danger");
                valid.classList.remove("text-success"); 
            }


            
        }

        if (id === "#tc"){
            // eğer 11 haneli ve tamamen sayılardan oluşuyorsa
            if (tc.value.length === length && !isNaN(tc.value)) {
                valid.classList.add("text-success");
                valid.classList.remove("text-danger");
            } else {
                valid.classList.add("text-danger");
                valid.classList.remove("text-success"); 
            }
        }
        if (id === "#email")
        {
            // eğer @ işareti varsa ve uzantısı varsa ve @ ile başlamıyorsa ve @ ile . bitişik değilse
            if (tc.value.includes("@") && tc.value.includes(".") && !tc.value.startsWith("@") && !tc.value.endsWith(".") && !tc.value.includes("@.")) {
                valid.classList.add("text-success");
                valid.classList.remove("text-danger");
            } else {
                valid.classList.add("text-danger");
                valid.classList.remove("text-success"); 
            }
        }
        
        // eğer şifre lenght uzunluğundaysa
        if (id === "#password")
        {
            if (validClass === ".password-length-valid")
            {
                if (tc.value.length >= length) {
                    valid.classList.add("text-success");
                    valid.classList.remove("text-danger");
                } else {
                    valid.classList.add("text-danger");
                    valid.classList.remove("text-success"); 
                }
            }

            if (validClass === ".password-words-valid")
            {
                // eğer büyük harf ve küçük harf varsa ve sayı varsa
                if (tc.value.match(/[A-Z]/g) && tc.value.match(/[a-z]/g) && tc.value.match(/[0-9]/g)) {
                    valid.classList.add("text-success");
                    valid.classList.remove("text-danger");
                    
                } else {
                    valid.classList.add("text-danger");
                    valid.classList.remove("text-success"); 
                }
            }
        }

        

        if (password2 !== null) {
            // eğer şifreler eşleşiyorsa
            const password2_ = document.querySelector(password2);
            // eğer herhangi biri boşsa
            if (tc.value === "" || password2_.value === "") {
                valid.classList.add("text-danger");
                valid.classList.remove("text-success");  
            }


            if (tc.value === password2_.value) {
                valid.classList.add("text-success");
                valid.classList.remove("text-danger");
            } else {
                valid.classList.add("text-danger");
                valid.classList.remove("text-success");  
            }
        }

        buttonActive();


    });
}
inputValid("#tc", ".tc-valid",11);
inputValid("#name", ".name-valid", 3);
inputValid("#email", ".email-valid");
inputValid("#password", ".password-length-valid", 8);
inputValid("#password", ".password-words-valid");
inputValid("#password", ".password-valid", 8, "#password2");
inputValid("#password2", ".password-valid", 8, "#password");

// bütün alanlarda text-success varsa butonu aktif et
function buttonActive() {
    const button = document.querySelector(".registerBtn");
    const valids = document.querySelectorAll(".list-group-item.m-2.text-success");
    if (valids.length === 6) {
        button.classList.remove("disabled");
    } else {
        button.classList.add("disabled");
    }
}

