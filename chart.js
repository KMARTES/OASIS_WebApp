function renderTDSChart(data) {
    const ctx = document.getElementById('tds');

    // Extracting data for the chart
    const labels = data.map(item => item.date + ' : ' + item.time);
    const tdsValues = data.map(item => parseFloat(item.tds));

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'TDS Values',
                data: tdsValues,
                backgroundColor: 'rgba(204, 0, 102, 1)',
                borderColor: 'rgba(204, 0, 102, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'TDS Data Collected',
                    color: 'gray'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Time Period',
                        color: 'gray'
                    },
                    ticks: {
                        color: 'gray'
                    },
                    grid: {
                        color: 'rgb(64, 64, 64)'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Total Dissolved Solids',
                        color: 'gray'
                    },
                    ticks: {
                        color: 'gray'
                    },
                    grid: {
                        color: 'rgb(64, 64, 64)'
                    }
                }
            }
        }
    });
}

function renderpHChart(data) {
    const ctx = document.getElementById('ph');

    const labels = data.map(item => item.date + ' : ' + item.time);
    const phValues = data.map(item => parseFloat(item.ph));

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'pH Values',
                data: phValues,
                backgroundColor: 'rgba(165, 55, 253, 1)',
                borderColor: 'rgba(165, 55, 253, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'pH Data Collected',
                    color: 'gray'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Time Period',
                        color: 'gray'
                    },
                    ticks: {
                        color: 'gray'
                    },
                    grid: {
                        color: 'rgb(64, 64, 64)'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'pH',
                        color: 'gray'
                    },
                    ticks: {
                        color: 'gray'
                    },
                    grid: {
                        color: 'rgb(64, 64, 64)'
                    }
                }
            }
        }
    });
}

function renderAmbTempChart(data) {
    const ctx = document.getElementById('ambtemp');

    const labels = data.map(item => item.date + ' : ' + item.time);
    const ambTempValues = data.map(item => parseFloat(item.ambient_temp));

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ambient Temperature Values',
                data: ambTempValues,
                backgroundColor: 'rgba(0, 200, 0, 1)',
                borderColor: 'rgba(0, 200, 0, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Ambient Temperature Data Collected',
                    color: 'gray'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Time Period',
                        color: 'gray'
                    },
                    ticks: {
                        color: 'gray'
                    },
                    grid: {
                        color: 'rgb(64, 64, 64)'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Ambient Temperature',
                        color: 'gray'
                    },
                    ticks: {
                        color: 'gray'
                    },
                    grid: {
                        color: 'rgb(64, 64, 64)'
                    }
                }
            }
        }
    });
}

function renderWatTempChart(data) {
    const ctx = document.getElementById('wattemp');

    const labels = data.map(item => item.date + ' : ' + item.time);
    const watTempValues = data.map(item => parseFloat(item.water_temp));

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Water Temperature Values',
                data: watTempValues,
                backgroundColor: 'rgba(255, 140, 0, 1)',
                borderColor: 'rgba(255, 140, 0, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Water Temperature Data Collected',
                    color: 'gray'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Time Period',
                        color: 'gray'
                    },
                    ticks: {
                        color: 'gray'
                    },
                    grid: {
                        color: 'rgb(64, 64, 64)'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Water Temperature',
                        color: 'gray'
                    },
                    ticks: {
                        color: 'gray'
                    },
                    grid: {
                        color: 'rgb(64, 64, 64)'
                    }
                }
            }
        }
    });
}

function renderAllTable(data) {
    const ctx = document.getElementById('alltable');

    const labels = data.map(item => item.month);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'TDS',
                data: data.map(item => parseFloat(item.tds)),
                backgroundColor: 'rgba(204, 0, 102, 1)',
                borderColor: 'rgba(204, 0, 102, 1)',
                borderWidth: 1,
                yAxisID: 'yTDS'
            }, {
                label:'pH',
                data: data.map(item => parseFloat(item.ph)),
                backgroundColor: 'rgba(165, 55, 253, 1)',
                borderColor: 'rgba(165, 55, 253, 1)',
                borderWidth: 1,
                yAxisID: 'yPH'
            }, {
                label: 'Ambient Temp',
                data: data.map(item => parseFloat(item.ambient_temp)),
                backgroundColor: 'rgba(0, 200, 0, 1)',
                borderColor: 'rgba(0, 200, 0, 1)',
                borderWidth: 1,
                yAxisID: 'y'
            }, {
                label: 'Water Temp',
                data: data.map(item => parseFloat(item.water_temp)),
                backgroundColor: 'rgba(255, 140, 0, 1)',
                borderColor: 'rgba(255, 140, 0, 1)',
                borderWidth: 1,
                yAxisID: 'y'
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'All Data',
                    color: 'gray'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Time Period',
                        color: 'gray'
                    },
                    ticks: {
                        color: 'gray'
                    },
                    grid: {
                        color: 'rgb(64, 64, 64)'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Temperature',
                        color: 'gray'
                    },
                    ticks: {
                        color: 'gray'
                    },
                    grid: {
                        color: 'rgb(64, 64, 64)'
                    }
                },
                yTDS: {
                    position: 'right',
                    title: {
                        display: true,
                        text: 'TDS',
                        color: 'gray'
                    }
                },
                yPH: {
                    position: 'right',
                    title: {
                        display: true,
                        text: 'pH',
                        color: 'gray'
                    }
                }
            }
        }
    });
}

function renderAllTDSChart(data1, data2, data3) {
    const allData = [...data1, ...data2, ...data3];

    const distinctMonths = [...new Set(allData.map(item => item.month))];

    const ctx = document.getElementById('alltds');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: distinctMonths,
            datasets: [{
                label: 'Nursery 1',
                data: data1.map(item => parseFloat(item.tds)),
                backgroundColor: 'rgba(217, 90, 0, 1)',
                borderColor: 'rgba(217, 90, 0, 1)',
                borderWidth: 1
            }, {
                label:'Nursery 2',
                data: data2.map(item => parseFloat(item.tds)),
                backgroundColor: 'rgba(90, 217, 0, 1)',
                borderColor: 'rgba(90, 217, 0, 1)',
                borderWidth: 1
            }, {
                label: 'Nursery 3',
                data: data3.map(item => parseFloat(item.tds)),
                backgroundColor: 'rgba(0, 90, 217, 1)',
                borderColor: 'rgba(0, 90, 217, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'TDS per Nursery',
                    color: 'gray'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Time Period',
                        color: 'gray'
                    },
                },
                y: {
                    title: {
                        display: true,
                        text: 'TDS',
                        color: 'gray'
                    },
                    ticks: {
                        color: 'gray'
                    },
                    grid: {
                        color: 'rgb(64, 64, 64)'
                    }
                }
            }
        }
    });
}

function renderAllpHChart(data1, data2, data3) {
    const allData = [...data1, ...data2, ...data3];

    const distinctMonths = [...new Set(allData.map(item => item.month))];

    const ctx = document.getElementById('allph');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: distinctMonths,
            datasets: [{
                label: 'Nursery 1',
                data: data1.map(item => parseFloat(item.ph)),
                backgroundColor: 'rgba(217, 90, 0, 1)',
                borderColor: 'rgba(217, 90, 0, 1)',
                borderWidth: 1
            }, {
                label:'Nursery 2',
                data: data2.map(item => parseFloat(item.ph)),
                backgroundColor: 'rgba(90, 217, 0, 1)',
                borderColor: 'rgba(90, 217, 0, 1)',
                borderWidth: 1
            }, {
                label: 'Nursery 3',
                data: data3.map(item => parseFloat(item.ph)),
                backgroundColor: 'rgba(0, 90, 217, 1)',
                borderColor: 'rgba(0, 90, 217, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'pH per Nursery',
                    color: 'gray'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Time Period',
                        color: 'gray'
                    },
                },
                y: {
                    title: {
                        display: true,
                        text: 'pH',
                        color: 'gray'
                    },
                    ticks: {
                        color: 'gray'
                    },
                    grid: {
                        color: 'gray'
                    }
                }
            }
        }
    });
}

function renderAllAmbTempChart(data1, data2, data3) {
    const allData = [...data1, ...data2, ...data3];

    const distinctMonths = [...new Set(allData.map(item => item.month))];

    const ctx = document.getElementById('allambtemp');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: distinctMonths,
            datasets: [{
                label: 'Nursery 1',
                data: data1.map(item => parseFloat(item.ambient_temp)),
                backgroundColor: 'rgba(217, 90, 0, 1)',
                borderColor: 'rgba(217, 90, 0, 1)',
                borderWidth: 1
            }, {
                label:'Nursery 2',
                data: data2.map(item => parseFloat(item.ambient_temp)),
                backgroundColor: 'rgba(90, 217, 0, 1)',
                borderColor: 'rgba(90, 217, 0, 1)',
                borderWidth: 1
            }, {
                label: 'Nursery 3',
                data: data3.map(item => parseFloat(item.ambient_temp)),
                backgroundColor: 'rgba(0, 90, 217, 1)',
                borderColor: 'rgba(0, 90, 217, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Ambient Temperature per Nursery',
                    color: 'gray'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Time Period',
                        color: 'gray'
                    },
                },
                y: {
                    title: {
                        display: true,
                        text: 'pH',
                        color: 'gray'
                    },
                    ticks: {
                        color: 'gray'
                    },
                    grid: {
                        color: 'rgb(64, 64, 64)'
                    }
                }
            }
        }
    });
}

function renderAllWatTempChart(data1, data2, data3) {
    const allData = [...data1, ...data2, ...data3];

    const distinctMonths = [...new Set(allData.map(item => item.month))];

    const ctx = document.getElementById('allwattemp');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: distinctMonths,
            datasets: [{
                label: 'Nursery 1',
                data: data1.map(item => parseFloat(item.water_temp)),
                backgroundColor: 'rgba(217, 90, 0, 1)',
                borderColor: 'rgba(217, 90, 0, 1)',
                borderWidth: 1
            }, {
                label:'Nursery 2',
                data: data2.map(item => parseFloat(item.water_temp)),
                backgroundColor: 'rgba(90, 217, 0, 1)',
                borderColor: 'rgba(90, 217, 0, 1)',
                borderWidth: 1
            }, {
                label: 'Nursery 3',
                data: data3.map(item => parseFloat(item.water_temp)),
                backgroundColor: 'rgba(0, 90, 217, 1)',
                borderColor: 'rgba(0, 90, 217, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Water Temperature per Nursery',
                    color: 'gray'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Time Period',
                        color: 'gray'
                    },
                },
                y: {
                    title: {
                        display: true,
                        text: 'pH',
                        color: 'gray'
                    },
                    ticks: {
                        color: 'gray'
                    },
                    grid: {
                        color: 'rgb(64, 64, 64)'
                    }
                }
            }
        }
    });
}

