
<div id="wrapper">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <div class=" justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mt-3" style="font-family: Nunito, sans-serif;">Dashboard</h3>
                    <form method="post" action="{{ route('pdf.generate') }}">
                      @csrf
                      <button type="submit" class='btn btn-primary' onclick="generate()">Generate PDF</button>
                  </form>

                    @if ($res->updateData->checkUD == 1)
                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="/updateData">
                      <i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;
                      Update Data
                    </a>
                    @endif
                </div>
                <div class="row">
                  <div class="col-md-6 col-xl-4 mb-4">
                      <div class="card shadow border-start-primary py-2">
                          <div class="card-body">
                              <div class="row align-items-center no-gutters">
                                  <div class="col">
                                      <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>main result</span></div>
                                      <div class="text-dark fw-bold h5 mb-0"><span>Ecology Center with  {{$res->initialResult->mainRes}}</span></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  @if ($res->initialResult->showAltRes == false)
                  @else
                  <div class="col-md-6 col-xl-4 mb-4">
                    <div class="card shadow border-start-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col">
                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Alternative Result</span></div>
                                    <div class="text-dark fw-bold h5 mb-0"><span>{{$res->initialResult->altRes}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  @endif
                  
                  <div class="col-md-6 col-xl-4 mb-4">
                      <div class="card shadow border-start-success py-2">
                          <div class="card-body">
                              <div class="row align-items-center no-gutters">
                                  <div class="col">
                                      <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>projected result</span></div>
                                      <div class="text-dark fw-bold h5 mb-0"><span>{{$res->projections->projectedResult}}</span></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-12 col-lg-12 col-xl-4 col-xxl-3 mb-4">
                    <div class="card shadow border-start-info py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Progress</span></div>
                                    <div class="row g-0 align-items-center d-flex justify-content-center">
                                        <div class="col-auto">
                                            <div class="text-dark fw-bold h5 mb-0 me-2"><span>{{$res->initialResult->startYear}}</span></div>
                                        </div>
                                        <div class="col-7 col-sm-9 col-md-8 col-lg-10 col-xl-8 col-xxl-7">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-info" aria-valuenow="{{$res->progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$res->progress}}%;"><span class="visually-hidden"></span></div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="text-dark fw-bold h5 mb-0 ms-2"><span>{{$res->projections->finalYear}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary fw-bold m-0">Residual and Projected Residual Waste</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area"><canvas id='residualWaste'></canvas></div>
                            </div>
                        </div>
                        <div class="card shadow mb-4">
                          <div class="card-header d-flex justify-content-between align-items-center">
                              <h6 class="text-primary fw-bold m-0">Projected Total Waste</h6>
                              <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle"    aria-expanded="false" data-bs-toggle="dropdown" type="button"></button>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                    <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                    <div class="dropdown-divider">
                                    </div>
                                    <a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                </div>
                              </div>
                          </div>
                        <div class="card-body">
                          <div class="chart-area">
                            <canvas id="projectedWaste"></canvas>
                          </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                      <div class="card-header d-flex justify-content-between align-items-center">
                          <h6 class="text-primary fw-bold m-0">Waste Breakdown</h6>
                          <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle"    aria-expanded="false" data-bs-toggle="dropdown" type="button"></button>
                            <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                <div class="dropdown-divider">
                                </div>
                                <a class="dropdown-item" href="#">&nbsp;Something else here</a>
                            </div>
                          </div>
                      </div>
                    <div class="card-body">
                      <div class="chart-area">
                        <canvas id="wasteBreakdown"></canvas>
                      </div>
                    </div>
                </div>
                  </div>
                    <div class="col-lg-7 col-xl-8">
                      <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary fw-bold m-0">Projected Population</h6>
                            <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                    <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                    <div class="dropdown-divider">
                                    </div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                              <canvas id="projectedPopulation"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-lg-5 col-xl-4">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary fw-bold m-0" id="wastebreakdown">Initial Data</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-link dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em" fill="currentColor" class="text-gray-400" style="font-size: 24px;">
                                            <path d="M128 192C110.3 192 96 177.7 96 160C96 142.3 110.3 128 128 128C145.7 128 160 142.3 160 160C160 177.7 145.7 192 128 192zM200 160C200 146.7 210.7 136 224 136H448C461.3 136 472 146.7 472 160C472 173.3 461.3 184 448 184H224C210.7 184 200 173.3 200 160zM200 256C200 242.7 210.7 232 224 232H448C461.3 232 472 242.7 472 256C472 269.3 461.3 280 448 280H224C210.7 280 200 269.3 200 256zM200 352C200 338.7 210.7 328 224 328H448C461.3 328 472 338.7 472 352C472 365.3 461.3 376 448 376H224C210.7 376 200 365.3 200 352zM128 224C145.7 224 160 238.3 160 256C160 273.7 145.7 288 128 288C110.3 288 96 273.7 96 256C96 238.3 110.3 224 128 224zM128 384C110.3 384 96 369.7 96 352C96 334.3 110.3 320 128 320C145.7 320 160 334.3 160 352C160 369.7 145.7 384 128 384zM0 96C0 60.65 28.65 32 64 32H512C547.3 32 576 60.65 576 96V416C576 451.3 547.3 480 512 480H64C28.65 480 0 451.3 0 416V96zM48 96V416C48 424.8 55.16 432 64 432H512C520.8 432 528 424.8 528 416V96C528 87.16 520.8 80 512 80H64C55.16 80 48 87.16 48 96z"></path>
                                        </svg></button>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                        <a class="dropdown-item"
                                        onclick="initialWasteProjection();">Initial data</a>
                                        <a class="dropdown-item"
                                        onclick="currentWasteProjection();">Current projection</a>
                                        <a class="dropdown-item"
                                        onclick="finalWasteProjection();">Final projection</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                  <canvas id="initialWaste"></canvas>
                                  <canvas id="currentWaste" style="display: none"></canvas>
                                  <canvas id="finalWaste" style="display: none"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Palawan DSS 2022</span></div>
                
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script>
  function generate() {
      alert("This PDF file will also be sent to the admin \n Press okay to start downloading");
  }
  </script>
<script>
  function initialWasteProjection() {
  document.getElementById("wastebreakdown").innerHTML = "Initial Data";
  document.getElementById("initialWaste").style.display = "flex";
  document.getElementById("currentWaste").style.display = "none"
  document.getElementById("finalWaste").style.display = "none";
  myBarChart.update();
}  

  function currentWasteProjection() {
  document.getElementById("wastebreakdown").innerHTML = "Current Projection";
  document.getElementById("initialWaste").style.display = "none";
  document.getElementById("currentWaste").style.display = "flex"
  document.getElementById("finalWaste").style.display = "none";
}  

  function finalWasteProjection() {
  document.getElementById("wastebreakdown").innerHTML = "Final Projection";
  document.getElementById("initialWaste").style.display = "none";
  document.getElementById("currentWaste").style.display = "none"
  document.getElementById("finalWaste").style.display = "flex";
}
</script>

<script>
  const totalWaste = [{label: "Initial Data", TW: '{{$res->waste->itotal}}'}, {label:"Final Projection", TW: "{{$res->waste->ptotal}}"}];
var myChart = new Chart('wasteBreakdown', {
    type: 'bar',
    data: {
      labels:['Initial Data','1st Update', '2nd Update', '3rd Update', '4th Update', 'Final Projection'],
        datasets: [{
            label: 'Biodegradable',
            data: ['{{$res->waste->ibio}}','{{$res->UData[0]->UD2ndBio}}','{{$res->UData[0]->UD4thBio}}','{{$res->UData[0]->UD6thBio}}','{{$res->UData[0]->UD8thBio}}','{{$res->waste->pbio}}'],
            backgroundColor: [
                '#4e73df',
                '#4e73df',
                '#4e73df',
                '#4e73df',
                '#4e73df',
                '#4e73df',
                '#4e73df'
            ],
            borderColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderWidth: 1
        },
        {
            label: 'Recyclable',
            data: ['{{$res->waste->irec}}','{{$res->UData[0]->UD2ndRec}}','{{$res->UData[0]->UD4thRec}}','{{$res->UData[0]->UD6thRec}}','{{$res->UData[0]->UD8thRec}}','{{$res->waste->prec}}'],
            backgroundColor: [
                '#1cc88a',
                '#1cc88a',
                '#1cc88a',
                '#1cc88a',
                '#1cc88a',
                '#1cc88a',
                '#1cc88a'
            ],
            borderColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderWidth: 1
        },
        {
            label: 'Residual',
            data: ['{{$res->waste->ires}}','{{$res->UData[0]->UD2ndRes}}','{{$res->UData[0]->UD4thRes}}','{{$res->UData[0]->UD6thRes}}','{{$res->UData[0]->UD8thRes}}','{{$res->waste->pres}}'],
            backgroundColor: [
                '#FDDA0D',
                '#FDDA0D',
                '#FDDA0D',
                '#FDDA0D',
                '#FDDA0D',
                '#FDDA0D',
                '#FDDA0D'
            ],
            borderColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderWidth: 1
        },{
            label: 'Special',
            data: ['{{$res->waste->ispe}}','{{$res->UData[0]->UD2ndSpe}}','{{$res->UData[0]->UD4thSpe}}','{{$res->UData[0]->UD6thSpe}}','{{$res->UData[0]->UD8thSpe}}','{{$res->waste->pspe}}'],
            backgroundColor: [
              'rgba(255,0,0,0.64)',
              'rgba(255,0,0,0.64)',
              'rgba(255,0,0,0.64)',
              'rgba(255,0,0,0.64)',
              'rgba(255,0,0,0.64)',
              'rgba(255,0,0,0.64)',
              'rgba(255,0,0,0.64)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderWidth: 1
        },
        {
            label: 'Total',
            data: totalWaste.map(o => ({ x: o.label, y: Number(o.TW)})),
            fill:false,
            backgroundColor: [
                '#000000'
            ],
            borderColor: [
                '#000000'
            ],
            borderWidth: 1,
            type:'line',
            
            
        }
      ]
    },
    options: {
      
      maintainAspectRatio:false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                },
                stacked: true
            }],
            xAxes: [{
              ticks: {
                    beginAtZero: true,
                    min:1
                },                
                stacked: true
            }]
        }
    }
});
myChart.data.datasets[4].hidden = true;
myChart.update();
</script>

<script>
    const residual = [{label: "{{$res->dates->initialDate}}", res: "{{$res->initialInput->res}}"}, {label: "{{$res->dates->currentDate}}", res: "{{$res->currentProjections->projectedRes}}"},{label: "{{$res->dates->finalDate}}", res: "{{$res->projections->projectedRes}}"}];
    const DRW1 = [{label: "{{$res->dates->initialDate}}", DRW: "{{$res->initialInput->drw}}"},{label: "{{$res->dates->currentDate}}", DRW: "{{$res->currentProjections->projectedDRW}}"},{label: "{{$res->dates->finalDate}}", DRW: "{{$res->projections->projectedDRW}}"}];
    const Population = [{label: "{{$res->dates->initialDate}}", pop: "{{$res->initialInput->pop}}"},{label: "{{$res->dates->currentDate}}", pop: "{{$res->currentProjections->projectedPop}}"},{label: "{{$res->dates->finalDate}}", pop: "{{$res->projections->projectedPop}}"}];
    const waste = [{label: "{{$res->dates->initialDate}}", w: "{{$res->waste->itotal}}"},{label: "{{$res->dates->currentDate}}", w: "{{$res->waste->ctotal}}"},{label: "{{$res->dates->finalDate}}", w: "{{$res->waste->ptotal}}"}];

    
    //residual chart
    new Chart("residualWaste", {
      type: 'line',
      data: {
        datasets: [{
            label: "Residual Waste",
            fill: false,
            data: residual.map(o => ({ x: o.label, y: Number(o.res)})),
            backgroundColor:'rgba(78, 115, 223, 1)',
            borderColor:'rgba(78, 115, 223, 1)'
          },
          {
            label: "Diverted Residual Waste",
            fill: false,
            data: DRW1.map(o => ({ x: o.label, y: Number(o.DRW)})),
            backgroundColor:'rgba(255,0,0,0.64)',
            borderColor:'rgba(255,0,0,0.64)'
          }

        ]
      },
      options: {
        maintainAspectRatio:false,
                legend:{
                    labels:{
                        fontStyle:'normal'
                    }
                },
                title:{
                    fontStyle:'normal'
                },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }],
          xAxes: [{
            type: 'time',
            barPercentage: 0.4,
            ticks: {
              maxTicksLimit: 3
                },
            time: {
              parser: 'MMM-YYYY',
              unit: 'year',
              displayFormats: {
                 year: 'YYYY'
              }
            }
          }]
        }
      }
    });

    //Total waste chart
    new Chart("projectedWaste", {
      type: 'bar',
      data: {
        datasets: [{
            label: "Total Waste",
            fill: false,
            data: waste.map(o => ({ x: o.label, y: Number(o.w)})),
            backgroundColor:'rgba(78, 115, 223, 1)',
            borderColor:'rgba(78, 115, 223, 1)',
            type:'line'
          }
        ]
      },
      options: {
        maintainAspectRatio:false,
                legend:{
                    labels:{
                        fontStyle:'normal'
                    }
                },
                title:{
                    fontStyle:'normal'
                },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }],
          xAxes: [{
            type: 'time',
            barPercentage: 5.5,
            ticks: {
              maxTicksLimit: 3
                },
            time: {
              parser: 'MMM-YYYY',
              unit: 'year',
              displayFormats: {
                 year: 'YYYY'
              }
            }
          }]
        }
      }
    });
    // population  chart
    new Chart("projectedPopulation", {
      type: 'line',
      data: {
        datasets: [{
            label: "Population",
            fill: false,
            data: Population.map(o => ({ x: o.label, y: Number(o.pop)})),
            backgroundColor:'rgba(78, 115, 223, 1)',
            borderColor:'rgba(78, 115, 223, 1)'
          }
        ]
      },
      options: {
        maintainAspectRatio:false,
                legend:{
                    display: false,
                    labels:{
                        fontStyle:'normal'
                    }
                },
                title:{
                    fontStyle:'normal'
                },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }],
          xAxes: [{
            type: 'time',
            ticks: {
              maxTicksLimit: 3
                },
            time: {
              parser: 'MMM-YYYY',
              unit: 'year',
              displayFormats: {
                 year: 'YYYY'
              }
            }
          }]
        }
      }
    });

    //specific waste chart
    const initialData = {
      labels: [
        'Biodegradable',
        'Recyclable',
        'Residual',
        'Special'
      ],
      datasets: [{
        label: 'Initial Waste',
        data: ['{{$res->waste->ibio}}', '{{$res->waste->irec}}', '{{$res->waste->ires}}','{{$res->waste->ispe}}'],
        backgroundColor: [
          '#4e73df',
          '#1cc88a',
          '#36b9cc',
          'rgba(255,0,0,0.64)'
        ],
        hoverOffset: 4
      }]
    };
    
    const currentData = {
      labels: [
        'Biodegradable',
        'Recyclable',
        'Residual',
        'Special'
      ],
      datasets: [{
        label: 'Current Projection',
        data: ['{{$res->waste->cbio}}', '{{$res->waste->crec}}', '{{$res->waste->cres}}','{{$res->waste->cspe}}'],
        backgroundColor: [
          '#1cc88a',  
          '#4e73df',
          'rgba(255,0,0,0.64)',
          '#36b9cc',
        ],
        hoverOffset: 4
      }]
    };
    
    const finalData = {
      labels: [
        'Biodegradable',
        'Recyclable',
        'Residual',
        'Special'
      ],
      datasets: [{
        label: 'Final Projection',
        data: ['{{$res->waste->pbio}}', '{{$res->waste->prec}}', '{{$res->waste->pres}}','{{$res->waste->pspe}}'],
        backgroundColor: [
          '#36b9cc',
          'rgba(255,0,0,0.64)',
          '#4e73df',          
          '#1cc88a',
        ],
        hoverOffset: 4
      }]
    };

    new Chart("initialWaste", {
      type: 'doughnut',
      data: initialData,
      options: {
            maintainAspectRatio:false
      }
    });
    
    new Chart("currentWaste", {
      type: 'doughnut',
      data: currentData,
      options: {
            maintainAspectRatio:false
      }
    });
    
    new Chart("finalWaste", {
      type: 'doughnut',
      data: finalData,
      options: {
            maintainAspectRatio:false
      }
    });
    /*const ctx = document.getElementById('myChart');

new Chart(ctx, 
    {
        type:'line',
        data:{labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug'],
            datasets:[{
                label:'Earnings',
                fill:true,
                data:[0,10000,1232,15000,10000,20000,15000,25000],
                backgroundColor:'rgba(78, 115, 223, 0.05)',
                borderColor:'rgba(78, 115, 223, 1)'
            }]
        },
        options:{
            maintainAspectRatio:false,
            legend:{
                display:false,
                labels:{
                    fontStyle:'normal'
                }
            },
            title:{
                fontStyle:'normal'
            },
            tooltips: {
       filter: function (tooltipItem, data) {
           var label = data.labels[tooltipItem.index];
           if (label == "Feb") {
             return false;
           } else {
             return true;
           }
       }
    },
            scales: {
      xAxes: [{
        ticks: {
          maxTicksLimit: 1
            }
        }]
        }
        }
    });*/
</script>
