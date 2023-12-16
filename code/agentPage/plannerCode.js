var DateTime = luxon.DateTime;


let currentDate = DateTime.local();
let currentWeekStart = currentDate.startOf('week');

function dayIndex(day) {
    const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    return days.indexOf(day);
}

function formatDate(date) {
    return date.toLocaleString({ weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
}

function showPrompt(day, time, occupiedData) {
    const dayIndexValue = dayIndex(day);
    const dayDate = currentWeekStart.plus({ days: dayIndexValue });

    const formattedDate = dayDate.toISODate();
    const formattedTime = time;

    const occupiedSlot = occupiedData.find(entry =>
        entry.date === formattedDate && entry.time_slot === formattedTime
    );

    let message;
    if (occupiedSlot) {
        if (occupiedSlot.approved === '1') {
            const slotInfo = Object.entries(occupiedSlot).map(([key, value]) => `${key}: ${value}`).join('\n');
            message = `Occupied:\n${slotInfo}\nDate: ${formattedDate}, Time: ${formattedTime}`;
        } else if (occupiedSlot.approved === '0') {
            message = `This slot is busy:\nDate: ${formattedDate}, Time: ${formattedTime}`;
        }
    } else {
        message = `You clicked on ${time} on ${day}, ${formattedDate}`;
    }

    alert(message);
}



function createButton(id, text, clickHandler) {
    const button = document.createElement('button');
    button.textContent = text;
    button.id = id;
    button.addEventListener('click', clickHandler);
    return button;
}

function createWeeklyPlanner(occupiedData) {
    console.log('Current Week Start:', currentWeekStart.toISODate());
    const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    const hours = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];

    const container = document.getElementById('planner-container');
    container.innerHTML = ''; // Clear the container

    const table = document.createElement('table');

    const navRow = document.createElement('tr');
    const navCell = document.createElement('td');
    navCell.colSpan = 8;

   // Input field for date
    const dateInput = document.createElement('input');
    dateInput.type = 'date';
    navCell.appendChild(dateInput);

    // Button to go to the week of the specified date
    const goToDateButton = createButton('goToDateButton', 'Go to Date', () => goToDate(dateInput.value, occupiedData));
    navCell.appendChild(goToDateButton);
    




    // Input field for week
    const weekInput = document.createElement('input');
    weekInput.type = 'number';
    weekInput.min = 1;
    weekInput.max = 52; // Assuming there are 52 weeks in a year
    weekInput.value = getWeekNumber(currentWeekStart);
    navCell.appendChild(weekInput);
    // Button to go to the specified week
    const goToWeekButton = createButton('goToWeekButton', 'Go to Week', () => goToWeek(weekInput.value));
    navCell.appendChild(goToWeekButton);

    const prevButton = createButton('previousButton', 'Previous Week', () => updateWeek(-7));
    const todayButton = createButton('todayButton', 'Today', () => updateWeek(0));
    const nextButton = createButton('nextButton', 'Next Week', () => updateWeek(7));


    navCell.appendChild(prevButton);
    navCell.appendChild(document.createTextNode(' '));
    navCell.appendChild(todayButton);
    navCell.appendChild(document.createTextNode(' '));
    navCell.appendChild(nextButton);
    navRow.appendChild(navCell);
    table.appendChild(navRow);

    const headerRow = document.createElement('tr');
    const emptyHeaderCell = document.createElement('th');
    headerRow.appendChild(emptyHeaderCell);

    for (let i = 0; i < 7; i++) {
        const th = document.createElement('th');
        const dayDate = currentWeekStart.plus({ days: i });
        th.textContent = days[i] + ' ' + dayDate.toISODate();
        headerRow.appendChild(th);
    }


    table.appendChild(headerRow);

    for (const hour of hours) {
        const row = document.createElement('tr');
        const timeCell = document.createElement('td');
        timeCell.textContent = hour;
        row.appendChild(timeCell);

        for (let i = 0; i < 7; i++) {
            const day = days[i];
            const td = document.createElement('td');
            const dayDate = currentWeekStart.plus({ days: i });

            const formattedDate = dayDate.toISODate();
            const formattedTime = hour;

            td.addEventListener('click', () => showPrompt(day, formattedTime, occupiedData));

            const isOccupied = occupiedData.some(entry =>
                entry.date === formattedDate && entry.time_slot === formattedTime && entry.approved === '1' // Check if approved is '1' (as a string)
            );

            const isBusy = occupiedData.some(entry =>
                entry.date === formattedDate &&
                entry.time_slot === formattedTime &&
                entry.approved === '0'  // Check if approved is '0' (as a string)
            );
            
            

            console.log(`Date: ${formattedDate}, Time: ${formattedTime}, isOccupied: ${isOccupied}, isBusy: ${isBusy}`); // Debug

            if (isOccupied) {
                td.classList.add('occupied');
            } else if (isBusy) {
                td.classList.add('busy');
            }

            row.appendChild(td);
        }

        table.appendChild(row);
    }

    container.appendChild(table);
}
function getISOWeekNumber(date) {
    return date.weekNumber;
}

function getWeekNumber(date) {
    return date.weekNumber;
}

function goToWeek(weekNumber) {
    if (weekNumber >= 1 && weekNumber <= 52) {
        const weekDiff = weekNumber - currentWeekStart.weekNumber;
        updateWeek(weekDiff * 7);
    } else {
        alert('Please enter a valid week number (1-52).');
    }
}


function goToWeek(weekNumber) {
    if (weekNumber >= 1 && weekNumber <= 52) {
        const currentWeekNumber = getISOWeekNumber(currentWeekStart);
        const offsetInWeeks = weekNumber - currentWeekNumber;
        const offsetInDays = offsetInWeeks * 7;

        updateWeek(offsetInDays);
    } else {
        alert('Please enter a valid week number (1-52).');
    }
}


function goToDate(dateString, occupiedData) {
    if (dateString) {
        const selectedDate = DateTime.fromISO(dateString);
        currentWeekStart = selectedDate.startOf('week');

        console.log('Updated Week to Date:', currentWeekStart.toISODate());
        createWeeklyPlanner(occupiedData); // Refresh the planner with the new week
    } else {
        alert('Please enter a valid date.');
    }
}



function updateWeek(offsetDays) {
    if (offsetDays === 0) {
        currentDate = DateTime.local();
        currentWeekStart = currentDate.startOf('week');
    } else {
        currentWeekStart = currentWeekStart.plus({ days: offsetDays });
    }

    console.log('Updated Week:', currentWeekStart.toISODate());
    console.log('Current Date:', currentDate.toISO()); // Updated this line
    console.log('Current Week Start:', new Date(currentWeekStart).toISOString().split('T')[0]);

    const selectedEmployeeId = document.getElementById('dynamicSelectEmployeePlanner').value;

    if (selectedEmployeeId) {
        fetchAppointments(selectedEmployeeId);
    } else {
        fetch('rdvTest.php')
            .then(response => response.json())
            .then(data => {
                console.log('Raw Data:', data);  // Log the raw data
                createWeeklyPlanner(data);
            })
            .catch(error => console.error('Error fetching data:', error));
    }
}

function fetchAppointments(employeeId) {
    fetch(`rdvTest.php?employee_id=${employeeId}`)
        .then(response => response.json())
        .then(data => {
            console.log('Raw Data:', data);  // Log the raw data
            createWeeklyPlanner(data);
        })
        .catch(error => console.error('Error fetching data:', error));
}

document.getElementById('plannerForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form submission and page reload

    const selectedEmployeeId = document.getElementById('dynamicSelectEmployeePlanner').value;

    if (selectedEmployeeId === '') {
        console.log('No employee selected');
    } else {
        fetchAppointments(selectedEmployeeId);
    }
});

// Initial fetch
fetch('rdvTest.php')
    .then(response => response.json())
    .then(data => {
        console.log('Raw Data:', data);  // Log the raw data
        createWeeklyPlanner(data);
    })
    .catch(error => console.error('Error fetching data:', error));
