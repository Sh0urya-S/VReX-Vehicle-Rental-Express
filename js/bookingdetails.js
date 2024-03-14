var availability = {
    "Toyota Corolla": "Available",
    "Honda Civic": "Not Available",
    "Ford Fusion": "Available",
    "Chevrolet Malibu": "Not Available",
    "Nissan Altima": "Available",
    "Jeep Wrangler": "Not Available",
    "Toyota RAV4": "Available",
    "Ford Escape": "Available",
    "Hyundai Tucson": "Not Available",
    "Kia Optima": "Available",
    "Trek FX 1": "Not Available",
    "Specialized Sirrus": "Available",
    "Giant Escape 3": "Not Available",
    "Cannondale Quick": "Available",
    "Trek Marlin 5": "Available",
    "Giant Talon 3": "Not Available",
    "Specialized Rockhopper": "Available",
    "Trek Dual Sport 2": "Available",
    "Cannondale Trail 8": "Not Available",
    "Giant Contend AR 3": "Available"
};

document.addEventListener('DOMContentLoaded', function() {
    var vehicleSelect = document.getElementById('vehicle-quantity');
    var bikeSelect = document.getElementById('bike-quantity');

    for (var vehicle in availability) {
        if (availability.hasOwnProperty(vehicle)) {
            var option = document.createElement('option');
            option.value = vehicle;
            option.text = vehicle;
            if (vehicle.includes("Toyota") || vehicle.includes("Honda") || vehicle.includes("Ford") || vehicle.includes("Chevrolet") || vehicle.includes("Nissan") || vehicle.includes("Jeep") || vehicle.includes("Hyundai") || vehicle.includes("Kia")) {
                vehicleSelect.appendChild(option);
            } else {
                bikeSelect.appendChild(option);
            }
        }
    }

    document.getElementById('vehicle-quantity').addEventListener('change', function() {
        var selectedCar = this.value;
        var carAvailabilityDiv = document.getElementById('car-availability');
        if (availability[selectedCar]) {
            carAvailabilityDiv.textContent = availability[selectedCar];
            carAvailabilityDiv.style.backgroundColor = availability[selectedCar] === 'Available' ? '#5cb85c' : '#d9534f';
        } else {
            carAvailabilityDiv.textContent = "Availability not found";
            carAvailabilityDiv.style.backgroundColor = '#e0e0e0';
        }
    });

    document.getElementById('bike-quantity').addEventListener('change', function() {
        var selectedBike = this.value;
        var bikeAvailabilityDiv = document.getElementById('bike-availability');
        if (availability[selectedBike]) {
            bikeAvailabilityDiv.textContent = availability[selectedBike];
            bikeAvailabilityDiv.style.backgroundColor = availability[selectedBike] === 'Available' ? '#5cb85c' : '#d9534f';
        } else {
            bikeAvailabilityDiv.textContent = "Availability not found";
            bikeAvailabilityDiv.style.backgroundColor = '#e0e0e0';
        }
    });
});
