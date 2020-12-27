const addActivityBtn=document.querySelector('#addActivityBtn');
const cancelBtn=document.querySelector('#cancelBtn');
const startTimerLink=document.querySelector('#startTimerLink');
const createActivityPop=document.querySelector('#createActivityForm');
const showDayDetail=document.querySelector('#showDayDetail');
const sectionDayDetail=document.querySelector('#sectionDayDetail');
var timerRefresh;



addActivityBtn.addEventListener("click",e=>{
    addActivityBtn.classList.add('inactive');
    createActivityForm.classList.remove('inactive');
})


cancelBtn.addEventListener("click",e=>{
    addActivityBtn.classList.remove('inactive');
    createActivityForm.classList.add('inactive');
})

showDayDetail.addEventListener("click",e=>{
    showDayDetail.classList.add('inactive');
    sectionDayDetail.classList.remove('inactive');
})


startTimerLink.addEventListener("click",e=>{
    
    startTimerLink.classList.add("inactive");
    //display timer
    addNewActivity(e);
    timerDisplayModule();
    document.querySelector('#activityName').disabled=true;
    document.querySelector('#activityName').style.backgroundColor= '#21E6C1';

    ////
    //CreateStopButton
    let stopTimer=document.createElement("button");
    stopTimer.classList.add('stop-btn');
    stopTimer.id='stopTimerBtn';
    stopTimer.textContent="Stop Timer";
    stopTimer.href="/main/end";
    startTimerLink.parentElement.appendChild(stopTimer);
    document.querySelector('#stopTimerBtn').addEventListener("click",e=>{
        endNewActivity(e);

        startTimerLink.nextElementSibling.remove();
        startTimerLink.classList.remove('inactive');
        document.querySelector('#activityName').value="";
        document.querySelector('#activityName').disabled=false;
        document.querySelector('#activityName').style.backgroundColor= '#FFFFFF';
        document.querySelector('#displayTimeText').remove();
        
        clearInterval(timerRefresh);
        
        setTimeout(()=>{
            window.location.reload();
            },1500);
        
        
        
    })
  /////
})


function timerDisplayModule(){
    const start = Date.now();
    const displayTime=document.createElement('h2');
    displayTime.id='displayTimeText';
    document.querySelector("#addActivityForm").appendChild(displayTime);
    timerRefresh=setInterval(function(){
        const actualTimer=new Date(Date.now()-start);
        const timeZoneOffset=actualTimer.getTimezoneOffset();
        const timer=actualTimer.getHours()+(timeZoneOffset/60)+"H "+actualTimer.getMinutes()+"Min "+actualTimer.getSeconds()+"s";
        document.querySelector("#displayTimeText").textContent=timer;
        
        
    },1000);
    
}

function addNewActivity(event){
    event.preventDefault();
    
    const url=startTimerLink.href;
    $value="empty";
    if(document.querySelector('#activityName').value===""){
        $value="empty";
    }else{
        $value=document.querySelector('#activityName').value;
    }
    
    axios.post(url,{
        activityName: $value
    })
}

function endNewActivity(event){
    event.preventDefault();

    const url=document.querySelector('#stopTimerBtn').href;
    
    axios.get(url).then(function(response){
         
        activitySuccess=document.querySelector('#activitySuccess');
        activitySuccess.classList.remove("inactive");
        activitySuccess.classList.add("activitySuccess");
        activitySuccess.textContent='Activity saved';
        setTimeout(()=>{
        activitySuccess=document.querySelector('#activitySuccess');
        activitySuccess.classList.add("inactive");
        activitySuccess.classList.remove("activitySuccess");
        activitySuccess.textContent='';
        
        },1500);
        
            
        
        

    });
}




