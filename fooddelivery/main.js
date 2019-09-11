// // const login=document.querySelector(".navbar .login");
// const price_=document.querySelector('.cart .price .foodprice');
// console.log(price_);
let totalprice=0;let charge=0;let vat=0;let total=0;
const price_=document.querySelectorAll('.food_details h2');
// const price_=document.querySelectorAll('.food_details h2');

// let item=[];

function login_popup(){
    // e.preventDefault();
    document.querySelector(".popup").style.display="block";
    document.querySelector("body").style.overflow="hidden";
}

function closewindow(e){
    if(e==1){
        document.querySelector(".popup").style.display="none";
        document.querySelector("body").style.overflow="scroll";
    }
    
    else{
        document.querySelector(".signup").style.display="none";
        document.querySelector("body").style.overflow="scroll";
    }
    
    // document.querySelector("body").style.overflow="scroll";
}

function signup_popup(){
    document.querySelector(".signup").style.display="block";
    document.querySelector("body").style.overflow="hidden";
}

function add_price(str){
    // item name--------------
    // document.querySelector('.menu_container .cart .foodlist .item').innerHTML="<P>"+fooditems_name+"</p>";


    // -----price-------------
    // totalprice=totalprice+price;
    // charge=totalprice*(2/100);
    // vat=totalprice*(5/100);
    // total=total+totalprice+charge+vat+100;
    // document.querySelector('.menu_container .cart .price .foodprice').innerHTML="<P>Food Price "+totalprice+".00tk </p>";
    // document.querySelector('.menu_container .cart .price .charge').innerHTML="<P>Restaurant srv.chg "+charge+"tk </p>";
    // document.querySelector('.menu_container .cart .price .vat').innerHTML="<P>VAT "+vat+" tk </p>";
    // document.querySelector('.menu_container .cart .price .delivery').innerHTML="<P>Delivery Fee "+100+".00tk </p>";
    // document.querySelector('.menu_container .cart .total').innerHTML="<P>Total "+total+" tk </p>";

    console.log(str);
}
function add_item(name){

}
function checkout()
{
    // console.log($_SESSION["name"]);
    document.querySelector('.menu_container .cart .cart_btn').href="order.php?price="+total;


}

