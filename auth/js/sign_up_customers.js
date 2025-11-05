function sign_up_customers(fname, mname, lname, address, contact_number, email, password, confirm_password) {
   if (confirm_password === password) {
      $.post("auth/php/sign_up_customers.php", 
         {
            fname: fname,
            mname: mname,
            lname: lname,
            address: address,
            contact_number: contact_number,
            email: email,
            password: password,
         }, 
         function(response) {
            if (response === "signed up") {
               alert("Signed up successfully!");
               window.location.href="index.php";
            }
      })
   } else {
      alert("Passwords don't match")
   }
}