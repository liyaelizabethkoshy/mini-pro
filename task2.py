def get_data():
    import MySQLdb
    c1=MySQLdb.connect("localhost","root","","project")
    x=c1.cursor()
    y=c1.cursor()
    x.execute("select rcod,rating,latitude,longitude from rlr")
    r1=x.fetchall()
    x.execute("select * from MENU")
    r2=x.fetchall()
    x.execute("select * from res")
    r3=x.fetchall()
    return r1,r2,r3

def edist(x,y):
    import math
    d=0.0
    for i in range(1,len(x)):
        d+=(int(x[i])-int(y[i]))**2
    return  math.sqrt(d)

def knn(tdata,check_item,k):
    import operator
    a,b=0,0
    e=[]
    for i in tdata:
        ed=edist(i,check_item)
        e.append((i[0],ed))
    e.sort(key=operator.itemgetter(1))
    e=e[:k]
    print "nearest k neighbors: "
    return e

def main():

    import sys
    l3=[]
    l4=[]
    h=[]
    (l1,l2,hot)=get_data()
    #print l1
    #print l2
    l=sys.argv[1]
    for i in l2:
        if l in i[1]:
            l3.append(i[0])
    for i in l3:
        for j in l1:
            if j[0]==i:
                l4.append(j)
    #print l4
    #location=raw_input("Enter location: ")
    location=sys.argv[2]
    from geopy.geocoders import Nominatim
    geolocator=Nominatim()
    loc=geolocator.geocode(location,timeout=10)
    t1=['',0,loc.latitude,loc.longitude]
    k=5
    if l4==[]:
        print "no match for item..have a look at available options"
        r=knn(l1,t1,k)
    else:
        r=knn(l4,t1,k)
    for i in r:
        for j in hot:
            if j[0]==i[0]:
                h.append(j[1])
    print h
    m=str(h)
    #return h
    f=open("ab.txt","w+")
    f.write(m)
    f.close()
    f=open("ab.txt","r")
    print f.read()
        
main()
