let currentDate = new Date();
let currentWeekStart = new Date(currentDate);
currentWeekStart.setDate(currentDate.getDate() - currentDate.getDay() + (currentDate.getDay() === 0 ? -6 : 1) + 1);
currentWeekStart.setHours(0, 0, 0, 0);



function dayIndex(day) {
    const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    return days.indexOf(day);
}

function formatDate(date) {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString(undefined, options);
}

// Declare showPrompt globally
function showPrompt(day, time, occupiedData) {
    const dayIndexValue = dayIndex(day);
    const dayDate = new Date(currentWeekStart);
    dayDate.setDate(currentWeekStart.getDate() + dayIndexValue);

    // Use UTC to avoid timezone-related issues
    const formattedDate = dayDate.toISOString().split('T')[0];
    const formattedTime = time;

    const occupiedSlot = occupiedData.find(entry =>
        entry.date === formattedDate && entry.time_slot === formattedTime
    );

    if (occupiedSlot) {
        const slotInfo = Object.entries(occupiedSlot)
            .map(([key, value]) => `${key}: ${value}`)
            .join('\n');
        alert(`Occupied:\n${slotInfo}\nDate: ${formattedDate}`);
    } else {
        alert(`You clicked on ${time} on ${day}, ${formattedDate}`);
    }
}




function createWeeklyPlanner(occupiedData) {
    console.log('Current Week Start:', new Date(currentWeekStart).toISOString().split('T')[0]);
    const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    const hours = ['9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];

    const container = document.getElementById('planner-container');
    container.innerHTML = ''; // Clear the container

    const table = document.createElement('table');

    // Create navigation row with previous and next buttons
    const navRow = document.createElement('tr');
    const navCell = document.createElement('td');
    navCell.colSpan = 8;

    // Use existing buttons if they exist, otherwise create new ones
    const prevButton = document.getElementById('previousButton') || document.createElement('button');
    prevButton.textContent = 'Previous Week';
    prevButton.id = 'previousButton';
    prevButton.addEventListener('click', () => updateWeek(-7));
    
    const todayButton = document.getElementById('todayButton') || document.createElement('button');
    todayButton.textContent = 'Today';
    todayButton.id = 'todayButton';
    todayButton.addEventListener('click', () => updateWeek(0));
    
    const nextButton = document.getElementById('nextButton') || document.createElement('button');
    nextButton.textContent = 'Next Week';
    nextButton.id = 'nextButton';
    nextButton.addEventListener('click', () => updateWeek(7));
    
    navCell.appendChild(prevButton);
    navCell.appendChild(document.createTextNode(' '));
    navCell.appendChild(todayButton);
    navCell.appendChild(document.createTextNode(' '));
    navCell.appendChild(nextButton);
    navRow.appendChild(navCell);
    table.appendChild(navRow);

    // Previous button event listener



    // Create table header with day names and dates
    const headerRow = document.createElement('tr');
    const emptyHeaderCell = document.createElement('th');
    headerRow.appendChild(emptyHeaderCell); // Empty cell in the top-left corner

    for (let i = 0; i < 7; i++) {
        const th = document.createElement('th');
        const dayDate = new Date(currentWeekStart);
        dayDate.setDate(currentWeekStart.getDate() + i);
    
        // Use UTC to avoid timezone-related issues
        th.textContent = days[i] + ' ' + dayDate.toISOString().split('T')[0];
        headerRow.appendChild(th);
    }
    

    table.appendChild(headerRow);

    // Create table rows with time slots
    for (const hour of hours) {
        const row = document.createElement('tr');

        // Time column
        const timeCell = document.createElement('td');
        timeCell.textContent = hour;
        row.appendChild(timeCell);

        // Day columns with clickable time slots
        for (let i = 0; i < 7; i++) {
            const day = days[i];
            const td = document.createElement('td');
            const dayDate = new Date(currentWeekStart);
            dayDate.setDate(currentWeekStart.getDate() + i);
        
            const formattedDate = dayDate.toISOString().split('T')[0];
            const formattedTime = hour;
        
            td.addEventListener('click', () => showPrompt(day, formattedTime, occupiedData));
        
            const isOccupied = occupiedData.some(entry =>
                entry.date === formattedDate && entry.time_slot === formattedTime
            );
            
        
            if (isOccupied) {
                td.classList.add('occupied');
            }
        
            row.appendChild(td);
        }
        

        table.appendChild(row);
    }

    container.appendChild(table);
}

function updateWeek(offset) {
    if (offset === 0) {
        currentDate = new Date();
        currentWeekStart = new Date(currentDate);
        currentWeekStart.setDate(currentDate.getDate() - currentDate.getDay() + (currentDate.getDay() === 0 ? -6 : 1) + 1);
        currentWeekStart.setHours(0, 0, 0, 0);
    } else {
        currentWeekStart = new Date(currentWeekStart);
        currentWeekStart.setDate(currentWeekStart.getDate() + offset);
    }

    console.log('Updated Week:', new Date(currentWeekStart).toISOString().split('T')[0]);
    console.log('Current Date:', currentDate.toISOString().split('T')[0]);
    console.log('Current Week Start:', new Date(currentWeekStart).toISOString().split('T')[0]);

    const selectedEmployeeId = document.getElementById('dynamicSelectEmployeePlanner').value;

    if (selectedEmployeeId) {
        fetchAppointments(selectedEmployeeId);
    } else {
        fetch('rdvTest.php')
            .then(response => response.json())
            .then(data => createWeeklyPlanner(data))
            .catch(error => console.error('Error fetching data:', error));
    }
}



fetch('rdvTest.php')
    .then(response => response.json())
    .then(data => createWeeklyPlanner(data))
    .catch(error => console.error('Error fetching data:', error));
function fetchAppointments(employeeId) {
        fetch(`rdvTest.php?employee_id=${employeeId}`)
            .then(response => response.json())
            .then(data => createWeeklyPlanner(data))
            .catch(error => console.error('Error fetching data:', error));
}
    
    
 

document.getElementById('plannerForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form submission and page reload
    
    const selectedEmployeeId = document.getElementById('dynamicSelectEmployeePlanner').value;

    if (selectedEmployeeId === '') {
        console.log('No employee selected');
    } else {
        // Fetch appointments for the selected employee
        fetchAppointments(selectedEmployeeId);
    }
});
