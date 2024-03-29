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

    if (occupiedSlot) {
        if (occupiedSlot.approved === '1') {
            fetchClientInfo(occupiedSlot.client_id, occupiedSlot, formattedDate, formattedTime);
        } else if (occupiedSlot.approved === '0') {
            const blockReason = occupiedSlot.block_reason ? occupiedSlot.block_reason : 'No reason provided';
            alert(`Date: ${formattedDate}, Time: ${formattedTime}\nThis slot is blocked\nReason: ${blockReason}`);
        }
    } else {
        alert(`You clicked on ${time} on ${day}, ${formattedDate}`);
    }
}


function fetchClientInfo(client_id, occupiedSlot, date, time) {
    fetch(`synthese/getClientInfoById.php?client_id=${client_id}`)
        .then(response => response.json())
        .then(clientData => {
            fetchAccounts(clientData.client_id, clientData, occupiedSlot, date, time);
        })
        .catch(error => {
            console.error('Error fetching client data:', error);
            alert('Error fetching client information.');
        });
}
function fetchAccounts(client_id, clientData, occupiedSlot, date, time) {
    fetch(`synthese/getAccountsById.php?client_id=${client_id}`)
        .then(response => response.json())
        .then(accountData => {
            if (accountData.error || accountData.length === 0) {
     
                accountData = { customMessage: 'No accounts associated with this client.' };
            }
            fetchContractInfo(clientData.client_id, clientData, accountData, occupiedSlot, date, time);
        })
        .catch(error => {
            console.error('Error fetching account data:', error);

            fetchContractInfo(clientData.client_id, clientData, { customMessage: error.message }, occupiedSlot, date, time);
        });
}


function fetchContractInfo(client_id, clientData, accountData, occupiedSlot, date, time) {
    console.log(`Fetching contract info with client_id: ${client_id}`);

    fetch(`synthese/getContractInfoByAccountId.php?client_id=${client_id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.statusText}`);
            }
            return response.json();
        })
        .then(contractData => {
            if (contractData.error || contractData.length === 0) {

                contractData = { customMessage: 'No contracts associated with this client.' };
            }
            console.log('Contract Data:', contractData);
            displayAllInfo(clientData, accountData, contractData, occupiedSlot, date, time);
        })
        .catch(error => {
            console.error('Error fetching contract data:', error);

            displayAllInfo(clientData, accountData, { customMessage: error.message }, occupiedSlot, date, time);
        });
}




function displayAllInfo(clientData, accountData, contractData, occupiedSlot, date, time) {
    const clientInfo = formatData(clientData, 'Client Info');
    const accountInfo = accountData.customMessage ? accountData.customMessage : formatData(accountData, 'Account Info', ['client_id']);
    const contractInfo = contractData.customMessage ? contractData.customMessage : formatData(contractData, 'Contract Info', ['client_id']);
    const slotInfo = formatData(occupiedSlot, 'Slot Info', ['client_id', 'motive_id', 'approved', 'block_reason', 'date', 'time_slot']);

    const message = `Date: ${date}, Time: ${time} \nOccupied:\n${slotInfo}\n\n${clientInfo}\n\n\n${accountInfo}\n\n\n${contractInfo}\n\n`;
    alert(message);
}




function formatData(data, title, excludeKeys = []) {
    if (Array.isArray(data)) {
        return `${title}:\n` + data.map((item, index) => 
            `Item ${index + 1}:\n` + Object.entries(item)
            .filter(([key]) => !excludeKeys.includes(key))
            .map(([key, value]) => `  ${key}: ${value}`)
            .join('\n')
        ).join('\n\n');
    } else {
        return `${title}:\n` + Object.entries(data)
            .filter(([key]) => !excludeKeys.includes(key))
            .map(([key, value]) => `${key}: ${value}`)
            .join('\n');
    }
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
    container.innerHTML = ''; 

    const table = document.createElement('table');

    const navRow = document.createElement('tr');
    const navCell = document.createElement('td');
    navCell.colSpan = 8;


    const dateInput = document.createElement('input');
    dateInput.type = 'date';
    navCell.appendChild(dateInput);


    const goToDateButton = createButton('goToDateButton', 'Go to Date', () => goToDate(dateInput.value, occupiedData));
    navCell.appendChild(goToDateButton);
    





    const weekInput = document.createElement('input');
    weekInput.type = 'number';
    weekInput.min = 1;
    weekInput.max = 52; 
    weekInput.value = getWeekNumber(currentWeekStart);
    navCell.appendChild(weekInput);

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
                entry.date === formattedDate && entry.time_slot === formattedTime && entry.approved === '1' 
            );

            const isBusy = occupiedData.some(entry =>
                entry.date === formattedDate &&
                entry.time_slot === formattedTime &&
                entry.approved === '0'  
            );
            
            

            console.log(`Date: ${formattedDate}, Time: ${formattedTime}, isOccupied: ${isOccupied}, isBusy: ${isBusy}`); 

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
        createWeeklyPlanner(occupiedData); 
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
    console.log('Current Date:', currentDate.toISO()); 
    console.log('Current Week Start:', new Date(currentWeekStart).toISOString().split('T')[0]);

    const selectedEmployeeId = document.getElementById('dynamicSelectEmployeePlanner').value;

    if (selectedEmployeeId) {
        fetchAppointments(selectedEmployeeId);
    } else {
        fetch('rdvTest.php')
            .then(response => response.json())
            .then(data => {
                console.log('Raw Data:', data);  
                createWeeklyPlanner(data);
            })
            .catch(error => console.error('Error fetching data:', error));
    }
}

function fetchAppointments(employeeId) {
    fetch(`rdvTest.php?employee_id=${employeeId}`)
        .then(response => response.json())
        .then(data => {
            console.log('Raw Data:', data);  
            createWeeklyPlanner(data);
        })
        .catch(error => console.error('Error fetching data:', error));
}

document.getElementById('plannerForm').addEventListener('submit', function (event) {
    event.preventDefault(); 

    const selectedEmployeeId = document.getElementById('dynamicSelectEmployeePlanner').value;

    if (selectedEmployeeId === '') {
        console.log('No employee selected');
    } else {
        fetchAppointments(selectedEmployeeId);
    }
});


