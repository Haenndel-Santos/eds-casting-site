



  document.addEventListener("DOMContentLoaded", () => {
    const ctx = document.getElementById("castingChart");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: [
          "Sand Casting", "Inv. (Water Glass)", "Inv. (Silica Sol)",
          "Shell Moulding", "Gravity Die", "HP Die", "Lost Foam", "Sintering"
        ],
        datasets: [
          {
            label: "Dimensional Accuracy",
            data: [1, 3, 5, 3, 4, 5, 3, 5],
            backgroundColor: "rgba(55, 180, 55, 0.8)"
          },
          {
            label: "Surface Finish",
            data: [1, 2, 5, 3, 4, 5, 3, 5],
            backgroundColor: "rgba(30, 144, 255, 0.7)"
          },
          {
            label: "Tooling Cost (lower is better)",
            data: [5, 5, 5, 4, 4, 3, 3, 1],
            backgroundColor: "rgba(255, 193, 7, 0.7)"
          },
          {
            label: "Machining Need",
            data: [1, 3, 4, 4, 3, 5, 4, 5],
            backgroundColor: "rgba(255, 99, 132, 0.7)"
          },
          {
            label: "Production Volume",
            data: [2, 2, 2, 3, 3, 4, 3, 5],
            backgroundColor: "rgba(123, 31, 162, 0.7)"
          },
          {
            label: "Manufacturing Cost (lower is better)",
            data: [5, 4, 3, 3, 3, 2, 2, 1],
            backgroundColor: "rgba(0, 150, 136, 0.7)"
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: "top"
          },
          title: {
            display: true,
            text: "Normalized Comparison of Casting Processes (Scale: 1 = poor, 5 = excellent)"
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                return `${context.dataset.label}: ${context.raw}/5`;
              }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            max: 5,
            ticks: {
              stepSize: 1
            },
            title: {
              display: true,
              text: "Normalized Performance Scale"
            }
          }
        }
      }
    });
  });

