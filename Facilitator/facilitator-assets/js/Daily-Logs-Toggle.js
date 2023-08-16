var dailylogsDiv = document.getElementById('dailylogs-div');
var tasksDiv = document.getElementById('tasks-div');

var dailylogsBtn = document.getElementById('dailylogs-btn');
var tasksBtn = document.getElementById('tasks-btn');

dailylogsBtn.onclick = function() {
    tasksDiv.setAttribute('class', 'hidden'); 
    dailylogsDiv.setAttribute('class', 'visible');
    
    document.getElementById("dailylogs-btn").style.cssText = `
    color: white;
    background-color: #0017eb;
    border: none;
    border-radius: 50px;
    width: 50%;
    font-size: 15px;
    padding: 0 12px;
    `;
    
    document.getElementById("tasks-btn").style.cssText = `
    color: #0017eb;
    background-color: white;
    border: 1px solid #0017eb;
    border-radius: 50px;
    width: 50%;
    font-size: 15px;
    padding: 0 12px;
    `;
};

tasksBtn.onclick = function() {
    dailylogsDiv.setAttribute('class', 'hidden');   
    tasksDiv.setAttribute('class', 'visible'); 
    
    document.getElementById("tasks-btn").style.cssText = `
    color: white;
    background-color: #0017eb;
    border: none;
    border-radius: 50px;
    width: 50%;
    font-size: 15px;
    padding: 0 12px;
    `;
    
    document.getElementById("dailylogs-btn").style.cssText = `
    color: #0017eb;
    background-color: white;
    border: 1px solid #0017eb;
    border-radius: 50px;
    width: 50%;
    font-size: 15px;
    padding: 0 12px;
    `;
};