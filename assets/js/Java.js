// ===== Image Slideshow =====
let currentSlide = 0;
const slides = document.querySelectorAll(".slider img");

function showNextSlide() {
  slides[currentSlide].classList.remove("active");
  currentSlide = (currentSlide + 1) % slides.length;
  slides[currentSlide].classList.add("active");
}

setInterval(showNextSlide, 3000);

// ===== Dropdown Fix (for mobile / click support) =====
document.querySelectorAll(".dropdown > a").forEach(menu => {
  menu.addEventListener("click", e => {
    e.preventDefault();
    const dropdown = menu.nextElementSibling;
    dropdown.style.display =
      dropdown.style.display === "block" ? "none" : "block";
  });
});


//----Contact ----//

// You can add interactivity later, for example to make the nav dropdown smoother
document.addEventListener("DOMContentLoaded", () => {
  console.log("Contact page loaded successfully!");
});

// ===Clubs===//
// Function to toggle club details when a club name is clicked
    document.querySelectorAll('.club-name').forEach(name => {
      name.addEventListener('click', function() {
        // Close all other club details
        document.querySelectorAll('.club-details').forEach(detail => {
          if (detail !== this.nextElementSibling) {
            detail.classList.remove('active');
            detail.previousElementSibling.classList.remove('active');
          }
        });
        
        // Toggle the clicked club details
        this.classList.toggle('active');
        this.nextElementSibling.classList.toggle('active');
      });
    });

    function showMembers(clubId) {
    document.getElementById(clubId + '-members').style.display = 'block';
}

function hideMembers() {
    let sections = document.querySelectorAll('.members-section');
    sections.forEach(sec => sec.style.display = 'none');
}
    
    // Function to show members for a specific club
    function showMembers(clubName) {
      // Hide all club details
      document.querySelectorAll('.club-details').forEach(detail => {
        detail.classList.remove('active');
        detail.previousElementSibling.classList.remove('active');
      });
      
      // Show the members section for the specified club
      document.getElementById(`${clubName}-members`).style.display = 'block';
      
      // Scroll to the members section
      document.getElementById(`${clubName}-members`).scrollIntoView({ behavior: 'smooth' });
    }
    
    // Function to hide members and go back to club details
    function hideMembers() {
      // Hide all members sections
      document.querySelectorAll('.members-section').forEach(section => {
        section.style.display = 'none';
      });
      
      // Scroll back to the clubs list
      document.querySelector('.clubs-list').scrollIntoView({ behavior: 'smooth' });
    }
    
    // Dropdown Fix (for mobile / click support)
    document.querySelectorAll(".dropdown > a").forEach(menu => {
      menu.addEventListener("click", e => {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          const dropdown = menu.nextElementSibling;
          dropdown.style.display =
            dropdown.style.display === "block" ? "none" : "block";
        }
      });
    });


    // ===== Feedback ====== //
    // Store feedback in localStorage (simulating server storage)
    let feedbackData = JSON.parse(localStorage.getItem('clubFeedback')) || [];
    
    // Form submission handler
    document.getElementById('feedbackForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const clubSelect = document.getElementById('clubSelect');
      const feedbackText = document.getElementById('feedbackText');
      
      // Create feedback object
      const feedback = {
        id: Date.now(),
        date: new Date().toLocaleDateString(),
        club: clubSelect.options[clubSelect.selectedIndex].text,
        clubValue: clubSelect.value,
        feedback: feedbackText.value,
        implemented: false
      };
      
      // Add to storage
      feedbackData.push(feedback);
      localStorage.setItem('clubFeedback', JSON.stringify(feedbackData));
      
      // Show success modal
      document.getElementById('successModal').style.display = 'flex';
      
      // Reset form
      this.reset();
      
      // Update admin table if visible
      if (document.getElementById('adminPanel').style.display === 'block') {
        updateAdminTable();
      }
    });
    
    // Close modal function
    function closeModal() {
      document.getElementById('successModal').style.display = 'none';
    }
    
    // Toggle admin panel
    function toggleAdminPanel() {
      const adminPanel = document.getElementById('adminPanel');
      if (adminPanel.style.display === 'block') {
        adminPanel.style.display = 'none';
      } else {
        adminPanel.style.display = 'block';
        updateAdminTable();
      }
    }
    
    // Update admin table with feedback data
    function updateAdminTable() {
      const tableBody = document.getElementById('feedbackTableBody');
      tableBody.innerHTML = '';
      
      if (feedbackData.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="4" style="text-align:center;">No feedback submitted yet</td></tr>';
        return;
      }
      
      // Sort by date (newest first)
      const sortedFeedback = [...feedbackData].sort((a, b) => b.id - a.id);
      
      sortedFeedback.forEach(feedback => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${feedback.date}</td>
          <td>${feedback.club}</td>
          <td>${feedback.feedback}</td>
          <td>
            <input type="checkbox" class="status-checkbox" ${feedback.implemented ? 'checked' : ''} 
                   onchange="updateFeedbackStatus(${feedback.id}, this.checked)">
          </td>
        `;
        tableBody.appendChild(row);
      });
    }
    
    // Update feedback implementation status
    function updateFeedbackStatus(id, implemented) {
      const feedbackIndex = feedbackData.findIndex(f => f.id === id);
      if (feedbackIndex !== -1) {
        feedbackData[feedbackIndex].implemented = implemented;
        localStorage.setItem('clubFeedback', JSON.stringify(feedbackData));
      }
    }
    
    // Dropdown Fix (for mobile / click support)
    document.querySelectorAll(".dropdown > a").forEach(menu => {
      menu.addEventListener("click", e => {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          const dropdown = menu.nextElementSibling;
          dropdown.style.display =
            dropdown.style.display === "block" ? "none" : "block";
        }
      });
    });


    //======== Help Desk =======//
    //---------------------------//
    // Store help requests in localStorage (simulating server storage)
    let helpRequests = JSON.parse(localStorage.getItem('helpRequests')) || [];
    
    // Form submission handler
    document.getElementById('helpForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const name = document.getElementById('name').value;
      const email = document.getElementById('email').value;
      const contact = document.getElementById('contact').value;
      const helpArea = document.getElementById('helpArea').value;
      const club = document.getElementById('club').value;
      const description = document.getElementById('description').value;
      
      // Create help request object
      const request = {
        id: Date.now(),
        date: new Date().toLocaleDateString(),
        name: name,
        email: email,
        contact: contact,
        helpArea: helpArea,
        club: document.getElementById('club').options[document.getElementById('club').selectedIndex].text,
        clubValue: club,
        description: description,
        status: 'pending'
      };
      
      // Add to storage
      helpRequests.push(request);
      localStorage.setItem('helpRequests', JSON.stringify(helpRequests));
      
      // Show success modal
      document.getElementById('successModal').style.display = 'flex';
      
      // Reset form
      this.reset();
      
      // Update admin table if visible
      if (document.getElementById('adminPanel').style.display === 'block') {
        updateAdminTable();
      }
    });
    
    // Close modal function
    function closeModal() {
      document.getElementById('successModal').style.display = 'none';
    }
    
    // Toggle admin panel
    function toggleAdminPanel() {
      const adminPanel = document.getElementById('adminPanel');
      if (adminPanel.style.display === 'block') {
        adminPanel.style.display = 'none';
      } else {
        adminPanel.style.display = 'block';
        updateAdminTable();
      }
    }
    
    // Update admin table with help requests
    function updateAdminTable() {
      const tableBody = document.getElementById('helpTableBody');
      tableBody.innerHTML = '';
      
      if (helpRequests.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="8" style="text-align:center;">No help requests submitted yet</td></tr>';
        return;
      }
      
      // Sort by date (newest first)
      const sortedRequests = [...helpRequests].sort((a, b) => b.id - a.id);
      
      sortedRequests.forEach(request => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${request.date}</td>
          <td>${request.name}</td>
          <td>${request.contact}<br>${request.email}</td>
          <td>${getHelpAreaText(request.helpArea)}</td>
          <td>${request.club}</td>
          <td>${request.description}</td>
          <td>
            <select class="status-select" onchange="updateRequestStatus(${request.id}, this.value)">
              <option value="pending" ${request.status === 'pending' ? 'selected' : ''}>Pending</option>
              <option value="in-progress" ${request.status === 'in-progress' ? 'selected' : ''}>In Progress</option>
              <option value="resolved" ${request.status === 'resolved' ? 'selected' : ''}>Resolved</option>
            </select>
          </td>
          <td>
            <button class="delete-btn" onclick="deleteRequest(${request.id})">Delete</button>
          </td>
        `;
        tableBody.appendChild(row);
      });
    }
    
    // Get readable text for help area
    function getHelpAreaText(value) {
      const areas = {
        'academic': 'Academic Support',
        'technical': 'Technical Assistance',
        'creative': 'Creative/Arts',
        'health': 'Health & Wellness',
        'social': 'Social Support',
        'career': 'Career Guidance',
        'other': 'Other'
      };
      return areas[value] || value;
    }
    
    // Update request status
    function updateRequestStatus(id, status) {
      const requestIndex = helpRequests.findIndex(r => r.id === id);
      if (requestIndex !== -1) {
        helpRequests[requestIndex].status = status;
        localStorage.setItem('helpRequests', JSON.stringify(helpRequests));
      }
    }
    
    // Delete request
    function deleteRequest(id) {
      if (confirm('Are you sure you want to delete this request?')) {
        helpRequests = helpRequests.filter(r => r.id !== id);
        localStorage.setItem('helpRequests', JSON.stringify(helpRequests));
        updateAdminTable();
      }
    }
    
    // Dropdown Fix (for mobile / click support)
    document.querySelectorAll(".dropdown > a").forEach(menu => {
      menu.addEventListener("click", e => {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          const dropdown = menu.nextElementSibling;
          dropdown.style.display =
            dropdown.style.display === "block" ? "none" : "block";
        }
      });
    });

//===========EVENT============//
//-----------------------------//
  // Sample events data - In real implementation, this would come from a database
    let eventsData = JSON.parse(localStorage.getItem('collegeEvents')) || [
      {
        id: 1,
        title: "Annual Literary Festival",
        club: "Literary Society",
        description: "A celebration of literature, poetry, and creative writing featuring guest authors, poetry slams, and writing workshops.",
        image: "images/literary-festival.jpg",
        date: "2025-11-20",
        time: "10:00 AM - 4:00 PM",
        location: "College Auditorium",
        type: "Festival",
        status: "upcoming"
      },
      {
        id: 2,
        title: "Blood Donation Camp",
        club: "Bhutan Red Cross Society",
        description: "Join us in saving lives by donating blood. All donors will receive a certificate and refreshments.",
        image: "images/blood-donation.jpg",
        date: "2025-11-25",
        time: "9:00 AM - 3:00 PM",
        location: "College Health Center",
        type: "Health Camp",
        status: "upcoming"
      },
      {
        id: 3,
        title: "Technical Workshop: Web Development",
        club: "Electrical Club",
        description: "Hands-on workshop covering HTML, CSS, and JavaScript basics. Perfect for beginners interested in web development.",
        image: "images/web-workshop.jpg",
        date: "2025-12-05",
        time: "2:00 PM - 5:00 PM",
        location: "Computer Lab 3",
        type: "Workshop",
        status: "upcoming"
      },
      {
        id: 4,
        title: "Cultural Night",
        club: "Tarayana",
        description: "An evening celebrating Bhutanese culture with traditional dances, music, and cuisine from different regions.",
        image: "images/cultural-night.jpg",
        date: "2025-10-15",
        time: "6:00 PM - 9:00 PM",
        location: "College Ground",
        type: "Cultural",
        status: "past"
      },
      {
        id: 5,
        title: "Y-Peer Health Awareness Session",
        club: "Y-Peer",
        description: "Interactive session on mental health awareness and stress management techniques for students.",
        image: "images/health-session.jpg",
        date: "2025-10-10",
        time: "3:00 PM - 5:00 PM",
        location: "Seminar Hall",
        type: "Awareness Session",
        status: "past"
      }
    ];

    // Initialize events
    document.addEventListener('DOMContentLoaded', function() {
      updateEventStatuses();
      loadEvents();
    });

    // Update event statuses based on current date
    function updateEventStatuses() {
      const currentDate = new Date();
      const oneWeekAgo = new Date(currentDate);
      oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);

      eventsData.forEach(event => {
        const eventDate = new Date(event.date);
        
        if (eventDate > currentDate) {
          event.status = 'upcoming';
        } else if (eventDate >= oneWeekAgo && eventDate <= currentDate) {
          event.status = 'past'; // Events from past week remain visible
        } else if (eventDate < oneWeekAgo) {
          // Remove events older than one week (or keep based on admin setting)
          // For demo, we'll keep them but mark as archived
          event.status = 'archived';
        }
      });

      // Save updated events
      localStorage.setItem('collegeEvents', JSON.stringify(eventsData));
    }

    // Load events into the page
    function loadEvents() {
      const upcomingContainer = document.getElementById('upcoming-events');
      const pastContainer = document.getElementById('past-events');

      // Clear containers
      upcomingContainer.innerHTML = '';
      pastContainer.innerHTML = '';

      // Filter events
      const upcomingEvents = eventsData.filter(event => event.status === 'upcoming');
      const pastEvents = eventsData.filter(event => event.status === 'past' || event.status === 'archived');

      // Display upcoming events
      if (upcomingEvents.length > 0) {
        upcomingEvents.forEach(event => {
          upcomingContainer.appendChild(createEventCard(event));
        });
      } else {
        upcomingContainer.innerHTML = '<div class="no-events">No upcoming events scheduled. Check back later!</div>';
      }

      // Display past events
      if (pastEvents.length > 0) {
        pastEvents.forEach(event => {
          pastContainer.appendChild(createEventCard(event));
        });
      } else {
        pastContainer.innerHTML = '<div class="no-events">No past events to display.</div>';
      }
    }

    // Create event card element
    function createEventCard(event) {
      const card = document.createElement('div');
      card.className = 'event-card';
      card.onclick = () => openEventModal(event);

      const formattedDate = new Date(event.date).toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });

      card.innerHTML = `
        <img src="${event.image}" alt="${event.title}" class="event-image" onerror="this.src='images/event-placeholder.jpg'">
        <div class="event-content">
          <div class="event-date">${formattedDate}</div>
          <h3 class="event-title">${event.title}</h3>
          <div class="event-club">By ${event.club}</div>
          <p class="event-description">${event.description}</p>
          <div class="event-details">
            <div class="event-time">${event.time} • ${event.location}</div>
            <div class="event-status ${event.status === 'upcoming' ? 'status-upcoming' : 'status-past'}">
              ${event.status === 'upcoming' ? 'Upcoming' : 'Past Event'}
            </div>
          </div>
        </div>
      `;

      return card;
    }

    // Show/hide sections
    function showSection(section) {
      // Update navigation buttons
      document.querySelectorAll('.events-nav-btn').forEach(btn => {
        btn.classList.remove('active');
      });
      event.target.classList.add('active');

      // Show/hide sections
      document.getElementById('upcoming-section').classList.remove('active');
      document.getElementById('past-section').classList.remove('active');
      document.getElementById(section + '-section').classList.add('active');

      // Update dropdown menu links
      if (section === 'upcoming') {
        document.querySelector('.dropdown-menu li:first-child a').classList.add('active');
        document.querySelector('.dropdown-menu li:last-child a').classList.remove('active');
      } else {
        document.querySelector('.dropdown-menu li:first-child a').classList.remove('active');
        document.querySelector('.dropdown-menu li:last-child a').classList.add('active');
      }
    }

    // Open event details modal
    function openEventModal(event) {
      const modal = document.getElementById('eventModal');
      const formattedDate = new Date(event.date).toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });

      document.getElementById('modalEventTitle').textContent = event.title;
      document.getElementById('modalEventDate').textContent = formattedDate;
      document.getElementById('modalEventImage').src = event.image;
      document.getElementById('modalEventTime').textContent = event.time;
      document.getElementById('modalEventLocation').textContent = event.location;
      document.getElementById('modalEventClub').textContent = event.club;
      document.getElementById('modalEventType').textContent = event.type;
      document.getElementById('modalEventDescription').textContent = event.description;

      modal.style.display = 'flex';
    }

    // Close modal
    function closeModal() {
      document.getElementById('eventModal').style.display = 'none';
    }

    // Toggle admin panel
    function toggleAdminPanel() {
      const adminPanel = document.getElementById('adminPanel');
      if (adminPanel.style.display === 'block') {
        adminPanel.style.display = 'none';
      } else {
        adminPanel.style.display = 'block';
        loadEventsManagement();
      }
    }

    // Load events management interface
    function loadEventsManagement() {
      const managementContainer = document.getElementById('events-management');
      // This would be a more complex interface in a real implementation
      managementContainer.innerHTML = `
        <div style="background: #f8f9fa; padding: 20px; border-radius: 6px;">
          <h3>Events Management</h3>
          <p>Total Events: ${eventsData.length}</p>
          <p>Upcoming: ${eventsData.filter(e => e.status === 'upcoming').length}</p>
          <p>Past: ${eventsData.filter(e => e.status === 'past').length}</p>
          <div style="margin-top: 15px;">
            <button class="events-nav-btn" onclick="exportEvents()">Export Events</button>
            <button class="events-nav-btn" onclick="clearPastEvents()" style="background-color: #dc3545; border-color: #dc3545;">Clear Old Events</button>
          </div>
        </div>
      `;
    }

    // Export events (for admin)
    function exportEvents() {
      const dataStr = JSON.stringify(eventsData, null, 2);
      const dataBlob = new Blob([dataStr], {type: 'application/json'});
      
      const link = document.createElement('a');
      link.href = URL.createObjectURL(dataBlob);
      link.download = 'college-events-backup.json';
      link.click();
    }

    // Clear old events (older than 30 days)
    function clearPastEvents() {
      if (confirm('Are you sure you want to clear events older than 30 days?')) {
        const thirtyDaysAgo = new Date();
        thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);
        
        eventsData = eventsData.filter(event => {
          const eventDate = new Date(event.date);
          return eventDate >= thirtyDaysAgo || event.status === 'upcoming';
        });
        
        localStorage.setItem('collegeEvents', JSON.stringify(eventsData));
        loadEvents();
        loadEventsManagement();
        alert('Old events cleared successfully!');
      }
    }

    // Dropdown Fix (for mobile / click support)
    document.querySelectorAll(".dropdown > a").forEach(menu => {
      menu.addEventListener("click", e => {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          const dropdown = menu.nextElementSibling;
          dropdown.style.display =
            dropdown.style.display === "block" ? "none" : "block";
        }
      });
    });

    // Close modal when clicking outside
    window.onclick = function(event) {
      const modal = document.getElementById('eventModal');
      if (event.target === modal) {
        closeModal();
      }
    }

