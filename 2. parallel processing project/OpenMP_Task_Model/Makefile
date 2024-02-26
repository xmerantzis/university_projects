DIM ?= 16
KNN ?= 32
TRA ?= 262144
QUE ?= 1024

LOW ?=  0
HIGH ?= 2


CFLAGS  = -DPROBDIM=$(DIM) -DNNBS=$(KNN) -DTRAINELEMS=$(TRA) -DQUERYELEMS=$(QUE) -DLB=$(LOW) -DUB=$(HIGH) -g -ggdb -O3
CFLAGS += -DSURROGATES -Wall -fopenmp
LDFLAGS += -lm

all: gendata myknnOMPTC

gendata: gendata.o
	gcc -o gendata gendata.o $(LDFLAGS)

gendata.o: gendata.c func.c
	gcc $(CFLAGS) -c gendata.c

myknnOMPTC: myknnOMPTC.o
	gcc -fopenmp -o myknnOMPTC myknnOMPTC.o $(LDFLAGS)

myknnOMPTC.o: myknnOMPTC.c func.c
	gcc -fopenmp $(CFLAGS) -c myknnOMPTC.c

clean:
	rm -f myknn *.o gendata
