
// sessionStorage.setItem
let html;

// getnotes();


let notes = localStorage.getItem("notes");
//alternative

shownotes();


let noteshead = localStorage.getItem("noteshead")
let container2 = document.getElementsByClassName("container2")[0];
let addbtn = document.getElementById("addbtn");
let bar = document.getElementById("lastline");
if (notes != null) {
    console.log("first");
    shownotes();
}
else {
    // console.log("Second ");
    container2.innerHTML = "<h4 class='heading'>No notes to show. Click on 'Add Notes' above to add one</h4>"
}
addbtn.addEventListener("click", function (e) {
    let addtext = document.getElementById("txtarea").value;
    let addtexthead = document.getElementById("addtexthead").value;
    console.log(addtext, addtexthead);
    // let notes = localStorage.getItem("notes");
    // let noteshead = localStorage.getItem("noteshead")
    // let notesobj;
    // let notesheadobj;

    // notesobj = JSON.parse(notes);
    // notesheadobj = JSON.parse(noteshead);
    // console.log("else");
    sendxhr(addtexthead, addtext, 'i').then(response => {
        console.log(response);
        shownotes();
    })


    // notesobj.push(addtext);
    // notesheadobj.push(addtexthead)
    // localStorage.setItem("notes", JSON.stringify(notesobj));
    // localStorage.setItem("noteshead", JSON.stringify(notesheadobj));

})

function shownotes(e) {


    sendxhr("", "", "s").then(response => {
        console.log(response);
        console.log(response.head);
        // console.log(response[0].head);
        console.log(response);
        let notesobj = response;
        // let notes = response.

        let html = "";
        notesobj.forEach(function (key, index) {
            html += `<div class="cards" id="${key.id}">
        <h3>${key.notehead}</h3>
        <div class="text">${key.notebody}</div>
        <button class="dlt" onclick="deleteone(${key.id})">Delete</button>
        </div>`


        });

        // console.log(html);
        container2.innerHTML = html;





    })

    return;

    // let notes = localStorage.getItem("notes");
    // let noteshead = localStorage.getItem("noteshead")
    // let notesobj = JSON.parse(notes);
    // let notesheadsobj = JSON.parse(noteshead);
    // console.log(notesheadsobj[0]);
    // html = "";
    // notesobj.forEach(function (element, index) {
    //     html += `<div class="cards" id="${index}">
    //         <h3>${notesheadsobj[index]}</h3>
    //         <div class="text">${element}</div>
    //         <button onclick="deleteone(${index})">Delete</button>
    //         </div>`
    // });
    // // console.log(html);
    // container2.innerHTML = html;


}

function deleteone(id) {
    console.log(id);
    let confirmation = window.confirm("Do you really want to delete this note permanently?");
    if (confirmation == true) {


        sendxhr(id, "", "d").then(message => {
            shownotes();

        })








        // let notes = localStorage.getItem("notes")
        // let noteshead = localStorage.getItem("noteshead")
        // if (notes == null) {
        //     notesobj = [];
        //     notesheadobj = [];
        // }
        // else {
        //     notesobj = JSON.parse(notes);
        //     notesheadobj = JSON.parse(noteshead);
        // }
        // notesobj.splice(id, 1);
        // notesheadobj.splice(id, 1);
        // localStorage.setItem("notes", JSON.stringify(notesobj));
        // localStorage.setItem("noteshead", JSON.stringify(notesheadobj));

    }
}
let deleteall = document.getElementById("deleteall");
deleteall.addEventListener("click", function () {
    let confirmation = window.confirm("Do you really want to delete all items");
    if (confirmation == true) {
        localStorage.clear();
        window.location.reload();
    }
    else { }
})







// let arr = [];
// document.getElementById("search").addEventListener("input", function () {
//     let searchval = document.getElementById("search").value;
//     let sresult = document.getElementById('sresult');
//     sresult.innerHTML = null;
//     let cardsarr = document.getElementsByClassName("cards");
//     console.log(cardsarr);
//     bar.style.animationName = "barmove";
//     // bar.style.top="400px";
//     bar.style.animationDuration = "2s";

//     // bar.style.animationDelay
//     // setTimeout(2000);
//     setTimeout(() => {
//         //    console.log(cards);
//         Array.from(cardsarr).forEach(element => {
//             if (searchval == null || searchval == "") {
//                 sresult.innerHTML = null;
//                 // element.style.position = "absolute";
//                 // element.style.top = "100px"
//                 // element.style.display = "block";
//             }

//             else if (element.getElementsByTagName("h3")[0].innerText.includes(searchval) || element.getElementsByClassName("text")[0].innerText.includes(searchval)) {
//                 console.log("Yes heading");
//                 arr.push(element);
//                 console.log(arr);

//                 //   sresult.innerHTML=" ";
//                 // let sresult = document.getElementById('sresult');

//                 // sresult.innerHTML+=`<div class="cards scards">
//                 // ${element.innerHTML}
//                 // </div>`

//                 sresult.style.margin = "10px";
//                 // console.log(sresult);
//             }
//             else {
//                 // sresult.innerHTML="Not Found";
//             }

//         });
//         if (arr.length != 0) {
//             sresult.style.display = "flex";
//             document.getElementById("belowsearch").style.display = "block";
//             arr.forEach(element => {
//                 sresult.innerHTML += `<div class="cards scards">
//                                 ${element.innerHTML}
//                                 </div>`
//             });
//             if (arr.length == 0) {
//                 sresult.style.display = "flex";
//                 console.log("sry ");
//                 sresult.innerHTML = "<h3>Oops your search keyword didnt mathch any results</h3>";
//             }
//             arr = [];
//         }
//         else {
//             let searchval = document.getElementById("search").value;
//             if (searchval != null) {
//                 // alert("Searchbox is empty")
//                 sresult.innerHTML = null;
//             }
//             else {
//                 sresult.style.display = "none";
//                 document.getElementById("belowsearch").style.display = "none";
//                 // sresult.innerHTML="<div>Sorry No result found</div>"
//             }
//         }

//     })
// }, 20000);

function sendxhr(notehead, notebody, a) {
    const url = "db-api.php";
    const formdata = new FormData();
    let uname = localStorage.getItem("username");
    let pass = localStorage.getItem("password");
    formdata.append('user', uname);
    formdata.append('pass', pass);
    formdata.append('action', a);
    formdata.append('notehead', notehead);
    formdata.append('notebody', notebody);
    return fetch(url, {
        method: "POST",
        body: formdata

    }).then(
        response => {
            if (!response.ok) {
                throw new Error('Response not found');
            }
            return response.json();

        });
    //.then(data => {
    //     console.log(data);
    // })
    // .catch(error => {
    //     console.error('There was a problem with the request', error);
    // })

}
//eg on how to use the function
// function getnotes(username, pass) {
//     sendxhr("asdf", "asdf").then(message => {
//         console.log(message.m);
//     })

// }