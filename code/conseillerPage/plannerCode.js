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
        entry.date === formattedDate && entry.timeslot === formattedTime
    );

    if (occupiedSlot) {
        alert(`Occupied: ${occupiedSlot.message}\nDate: ${formattedDate}`);
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
    const prevButton = document.createElement('button');
    prevButton.textContent = 'Previous Week';
    prevButton.addEventListener('click', () => updateWeek(-7));
    const todayButton = document.createElement('button');
    todayButton.textContent = 'Today';
    todayButton.addEventListener('click', () => updateWeek(0));
    const nextButton = document.createElement('button');
    nextButton.textContent = 'Next Week';
    nextButton.addEventListener('click', () => updateWeek(7));
    navCell.appendChild(prevButton);
    navCell.appendChild(document.createTextNode(' '));
    navCell.appendChild(todayButton);
    navCell.appendChild(document.createTextNode(' '));
    navCell.appendChild(nextButton);
    navRow.appendChild(navCell);
    table.appendChild(navRow);

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
                entry.date === formattedDate && entry.timeslot === formattedTime
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
        currentWeekStart = new Date(currentWeekStart); // Convert to Date object
        currentWeekStart.setDate(currentWeekStart.getDate() + offset);
    }

    console.log('Updated Week:', new Date(currentWeekStart).toISOString().split('T')[0]);
    console.log('Current Date:', currentDate.toISOString().split('T')[0]);
    console.log('Current Week Start:', new Date(currentWeekStart).toISOString().split('T')[0]);

    fetch('rdvTest.php')
        .then(response => response.json())
        .then(data => createWeeklyPlanner(data))
        .catch(error => console.error('Error fetching data:', error));
}


fetch('rdvTest.php')
    .then(response => response.json())
    .then(data => createWeeklyPlanner(data))
    .catch(error => console.error('Error fetching data:', error));